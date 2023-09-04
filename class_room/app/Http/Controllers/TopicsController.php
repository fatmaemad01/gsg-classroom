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
    public function index(Classroom $classroom)
    {
        $topics = $classroom->topics;
        $classworks = $classroom->classworks()->with('topic')->get();

        return view('topics.index', [
            'topics' => $topics,
            'classworks'=> $classworks->groupBy('topic_id'),
            'classroom' => $classroom
        ]);
    }

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

        // return redirect()->route('classroom.show', $classroom->id);
        return back();
    }


    public function show(Topic $topic)
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



    public function update(TopicRequest $request, Topic $topic)
    {
        $validated = $request->validated();

        $topic->update($validated);

        return back();
    }


    public function destroy(Topic $topic): RedirectResponse
    {
        $topic->delete();

        return redirect()->route('classrooms.classworks.index', $topic->classroom_id);
    }
}
