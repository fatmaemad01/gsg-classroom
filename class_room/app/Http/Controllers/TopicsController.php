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

        return redirect()->route('topics.trashed', $topic->classroom_id);
    }


    public function trashed()
    {
        $topics = Topic::onlyTrashed()->latest('deleted_at')->get();
        return view('topics.trashed' , compact('topics'));

    }

    public function restore($id)
    {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->restore();

        return redirect()->route('classroom.index')->with('success' , "Topic $topic->name Restored");
    }

    public function forceDelete($id)
    {
        $topic = Topic::onlyTrashed()->findOrFail($id);
        $topic->forceDelete();

        return redirect()->route('topics.trashed')->with('success' , "Topic $topic->name Deleted");

    }
}

