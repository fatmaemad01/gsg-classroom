<?php

namespace App\Http\Controllers;

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

        return redirect()->route('classroom.show',  [
            $classroom->id,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post->update($request->all());

        return back();
    }

    
    public function destroy(Classroom $classroom, Post $post)
    {
        $post->delete();

        return redirect()->route('classroom.show', $classroom->id);
    }
}
