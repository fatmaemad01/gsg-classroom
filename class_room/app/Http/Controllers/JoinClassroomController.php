<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Scopes\UserClassroomScope;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JoinClassroomController extends Controller
{
    public function create($id)
    {
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)
            ->active()
            ->findOrFail($id);

        // if we need to make custom error message , make above function find to check error
        // findOrFail check error and return 404
        // if(! $classroom){
        //     return view('classroom.errorMessage');
        // }

        try {
            $this->exists($id, Auth::id());
        } catch (Exception $e) {
            return redirect()->route('classrooms.show', $id);
        }


        return view('classrooms.join', compact('classroom'));
    }


    public function store(Request $request, $id)
    {
        $request->validate([
            'role' => 'in:student,teacher'
        ]);

        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)
            ->active()
            ->findOrFail($id);
        try {
            $this->exists($id, Auth::id());
        } catch (Exception $e) {
            return redirect()->route('classroom.show', $id);
        }

        $classroom->join(Auth::id() , 'student');
        
        return redirect()->route('classroom.show', $id);

    }


    protected function exists($classroom_id, $user_id)
    {
        $exists =  DB::table('classroom_user')
            ->where('classroom_id', $classroom_id)
            ->where('user_id', $user_id)
            ->exists();

        if ($exists) {
            throw new Exception('User already joined the classroom');
        }
    }
}
