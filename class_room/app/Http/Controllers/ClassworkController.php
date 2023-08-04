<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassworkController extends Controller
{

    public function index(Request $request, Classroom $classroom)
    {
        $classworks = $classroom->classworks()
        ->with('topic') // Eager load
        ->orderBy('published_at', 'DESC')
        ->get();

        $type = $this->getType($request);
        
        return view('classworks.index', [
            'classroom' => $classroom,
            'classworks' => $classworks->groupBy('topic_id'),
            'type' => $type
        ]);
    }


    public function create(Request $request ,Classroom $classroom)
    {
        $type = $this->getType($request);

        return view('classworks.create', [
            'classroom' => $classroom ,
             'type' => $type ,
             'classwork' => new Classwork(),
        ]);
    }


    public function store(Request $request, Classroom $classroom)
    {
        $type = $this->getType($request);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id']
        ]);

        $request->merge([
            'user_id' => Auth::id(),
            // 'classroom_id' => $classroom->id 
        ]);

        // here we don't need to pass classroom_id , will take it from relation
        $classwork =  $classroom->classworks()->create($request->all());

        return redirect()
            ->route('classrooms.classworks.index', $classroom->id)
            ->with('success', 'Classwork created!');
    }


    public function show(Classroom $classroom, Classwork $classwork)
    {
    }


    public function edit(Request $request, Classroom $classroom, Classwork $classwork)
    {
        $type = $this->getType($request);

        return view('classworks.edit', [
            'classroom' => $classroom,
            'classwork' => $classwork,
            'type' => $type
        ]);
    }


    public function update(Request $request, Classroom $classroom, Classwork $classwork)
    {
        $type = $this->getType($request);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'topic_id' => 'nullable|int|exists:topics,id'
        ]);

        $classwork->update($request->all());

        return redirect()->route('classrooms.classworks.index', (" $classroom->id , $type"))
            ->with('success', 'Classwork Updated');
    }


    public function destroy(Classroom $classroom, Classwork $classwork)
    {
        $classwork->delete();

        return redirect()->route('classrooms.classworks.index', $classroom->id);
    }

    protected function getType()
    {
        $type = request()->query('type');
        $allowed_types = [
            Classwork::TYPE_ASSIGNMENT, Classwork::TYPE_MATERIAL, Classwork::TYPE_QUESTIONS
        ];
        if (!in_array($type, $allowed_types)) {
            $type = Classwork::TYPE_ASSIGNMENT;
        }
        return $type;
    }
}
