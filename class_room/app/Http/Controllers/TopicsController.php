<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    public function create($id)
    {
        $classroom = Classroom::FindOrFail($id);
        return view('topics.create', [
            'classroom' => $classroom,
        ]);
    }

    public function store(Request $request, $id): RedirectResponse
    {
        // $classroom = Classroom::FindOrFail($id)->first();
        $classroom = Classroom::FindOrFail($id);
        $topic = new Topic();
        $topic->name = $request->post('name');
        $topic->classroom_id = $classroom->id;
        $topic->save();

        return redirect()->route('classroom.show', $classroom->id);
    }


    public function edit($id)
    {
        $topic = Topic::FindOrFail($id);
        return view('topics.edit', [
            'topic' => $topic,
        ]);
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update($request->all());

        return redirect()->route('classroom.show', $topic->classroom_id);
    }

    public function destroy($id): RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        return redirect()->route('classroom.show', $topic->classroom_id);
    }
}
