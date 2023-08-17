<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ClassworkController extends Controller
{

    public function index(Request $request, Classroom $classroom)
    {
        // here we create query without get data
        $classworks = $classroom->classworks()
            ->with('topic') // Eager load
            // search feature
            ->filter($request->query())
            ->latest('published_at', 'DESC') // Query builder
            ->get();

        $type = $this->getType($request);

        return view('classworks.index', [
            'classroom' => $classroom,
            'classworks' => $classworks->groupBy('topic_id'),
            'type' => $type
        ]);
    }


    public function create(Request $request, Classroom $classroom)
    {
        // dd($this->getType($request->type));
        $type = $this->getType($request);

        // $assigned = $classwork->users()->pluck('id')->toArray();

        return view('classworks.create', [
            'classroom' => $classroom,
            'type' => $type,
            'classwork' => new Classwork(),
        ]);
    }


    public function store(Request $request, Classroom $classroom)
    {
        $type = $this->getType($request);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn () => $type == 'assignment'), 'numeric', 'min:0'],
            'options.due' => 'nullable|date|after:published_at',
        ]);

        $request->merge([
            'user_id' => Auth::id(),
            'type' => $type
            // 'classroom_id' => $classroom->id 
        ]);

        try {
            DB::transaction(function () use ($classroom, $request) {


                // here we don't need to pass classroom_id , will take it from relation
                $classwork =  $classroom->classworks()->create($request->all());

                $classwork->users()->attach($request->input('students'));
            });
        } catch (QueryException $ex) {
            return back();
        }

        return redirect()
            ->route('classrooms.classworks.index', $classroom->id)
            ->with('success', 'Classwork created!');
    }


    public function show(Classroom $classroom, Classwork $classwork)
    {
        $classwork->load('comments.user');

        $submissions = Auth::user()->submissions()->where('classwork_id', $classwork->id)->get();

        return view('classworks.show', compact('classwork', 'classroom' , 'submissions'));
    }


    public function edit(Request $request, Classroom $classroom, Classwork $classwork)
    {
        // dd( $classwork->type->value);
        $type = $classwork->type->value;

        $assigned = $classwork->users()->pluck('id')->toArray();

        return view('classworks.edit', [
            'classroom' => $classroom,
            'classwork' => $classwork,
            'type' => $type,
            'assigned' => $assigned
        ]);
    }


    public function update(Request $request, Classroom $classroom, Classwork $classwork)
    {
        $type = $classwork->type;

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'topic_id' => ['nullable', 'int', 'exists:topics,id'],
            'options.grade' => [Rule::requiredIf(fn () => $type == 'assignment'), 'numeric', 'min:0'],
            'options.due' => 'nullable|date|after:published_at',
        ]);


        $classwork->update($request->all());

        // sync accept array of values 
        // update the values => update table value to be equal with array values
        $classwork->users()->sync($request->input('students'));


        // if we need to update without remove the old checked values (keep array value & table value) we use 
        // $classwork->users()->syncWithoutDetaching($request->input('students'));


        return redirect()->route('classrooms.classworks.index', ([$classroom->id, $type]))
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
