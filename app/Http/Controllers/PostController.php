<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Events\PostUpdated;
use App\Models\Post;
use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{


    public function store(Request $request, Classroom $classroom)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        $post =  $classroom->posts()->create($request->all());

        event(new PostCreated($post));

        return redirect()->route('classroom.show',  [
            $classroom->id,
        ]);
    }

    public function show(Post $post)
    {
        return view('classrooms.post', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post->update($request->all());

        event(new PostUpdated($post));
        return back();
    }


    public function destroy(Classroom $classroom, Post $post)
    {
        $post->delete();

        return redirect()->route('classroom.show', $classroom->id);
    }
}
