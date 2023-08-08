<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomPeopleController extends Controller
{
    public function index(Classroom $classroom)
    {
        return view('classrooms.people', compact(['classroom']));
    }

    public function destroy(Request $request, Classroom $classroom)
    {
        // detach used to delete user from classroom (user-classroom table) not from database .. using relation 
        $request->validate([
            'user_id' => 'required'

        ]);

        $user_id = $request->input('user_id');
        if ($user_id == $classroom->user_id) {
            return redirect()->route('classroom.people', $classroom->id)
                ->with('error', 'Cannot remove user!');
        }
        $classroom->users()->detach($user_id);


        return redirect()->route('classroom.people', $classroom->id)
            ->with('success', 'User removed!');
    }
}
