<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    public function create(Classroom $classroom)  // here i was pass $classroom object because i need to store topic dynamic
    {
        return view('topics.create', [
            'classroom' => $classroom,
            'topic' => New Topic(),
        ]);
    }


    public function store(TopicRequest $request, Classroom $classroom): RedirectResponse
    {
        $validated = $request->validated();

        $validated ['classroom_id'] = $classroom->id;
        $topic = Topic::create($validated);

        return redirect()->route('classroom.show', $classroom->id);
    }


    public function edit(Topic $topic)
    {
        return view('topics.edit', [
            'topic' => $topic,
        ]);
    }


    public function update(TopicRequest $request, Topic $topic)
    {
        $validated = $request->validated();

        $topic->update($validated);

        return redirect()->route('classroom.show', $topic->classroom_id);
    }

    
    public function destroy(Topic $topic): RedirectResponse
    {
        $topic->delete();

        return redirect()->route('classroom.show', $topic->classroom_id);
    }
}
