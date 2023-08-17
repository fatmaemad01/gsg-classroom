<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    // public function index(Classroom $classroom , Topic $topic)
    // {
    //     $classworks = $topic->classworks;

    //     return view('topics.index' , compact('classworks' , 'classroom'));
    // }

    public function create(Classroom $classroom)
    {
        return view('topics.create', [
            'classroom' => $classroom,
            'topic' => new Topic(),
        ]);
    }


    public function store(TopicRequest $request, Classroom $classroom): RedirectResponse
    {
        $validated = $request->validated();

        $validated['classroom_id'] = $classroom->id;
        $topic = Topic::create($validated);

        return redirect()->route('classroom.show', $classroom->id);
    }


    public function show( Topic $topic )
    {
        $classworks =  $topic->classworks()->with('topic')->get();
        $classroom = $topic->classroom;
        // $topic = $classwork->topic;
        return view(
            'topics.show',
            [
                'topic' => $topic,
                'classroom' => $classroom,
                'classworks' => $classworks->groupBy('topic_id'),
            ]
        );
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


    // public function trashed()
    // {
    //     $topics = Topic::onlyTrashed()->latest('deleted_at')->get();
    //     return view('topics.trashed' , compact('topics'));

    // }

    // public function restore($id)
    // {
    //     $topic = Topic::onlyTrashed()->findOrFail($id);
    //     $topic->restore();

    //     return redirect()->route('classroom.index')->with('success' , "Topic $topic->name Restored");
    // }

    // public function forceDelete($id)
    // {
    //     $topic = Topic::onlyTrashed()->findOrFail($id);
    //     $topic->forceDelete();

    //     return redirect()->route('topics.trashed')->with('success' , "Topic $topic->name Deleted");

    // }
}
