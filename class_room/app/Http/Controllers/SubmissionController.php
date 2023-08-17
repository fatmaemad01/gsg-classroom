<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Classwork;
use App\Models\Submission;
use App\Rules\ForbiddenFile;
use Illuminate\Http\Request;
use App\Models\ClassworkUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{

    public function store(Request $request, Classwork $classwork)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => ['file', new ForbiddenFile('text/x-php', 'application/x-msdownload')]
        ]);

        $assigned = $classwork->classroom->students()->where('id', Auth::id())->exists();
        // dd($assigned);
        if (!$assigned) {
            abort(403);
        }

        DB::beginTransaction();
        try {
            $data = [];
            foreach ($request->file('files') as $file) {
                $data[] = [
                    'user_id' => Auth::id(),
                    'classwork_id' => $classwork->id,
                    'content' => $file->store("submissions/{$classwork->id}"),
                    'type' => 'file'
                ];
            }

            $user = Auth::user();
            $user->submissions()->createMany($data);

            // Submission::insert($data);

            ClassworkUser::where([
                'user_id' => Auth::id(),
                'classwork_id' => $classwork->id,
            ])->update([
                'status' => 'submitted',
                'submitted_at' => now()
            ]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', 'Work Submitted');
    }


    public function file(Submission $submission)
    {
        $user = Auth::user();
        // Check if the user is classroom teacher

        /*
        select * FROM classroom_user 
        WHERE user_id = ?
        AND role = teacher
        AND  EXISTS (
            SELECT 1 FROM classworks.classroom_id = classroom_user.classroom_id 
             AND EXISTS  (
                SELECT 1 FROM submission WHERE submissions.classwork_id =  classworks.id id=? 
            )
        ) 
        */

        DB::select('select * FROM classroom_user 
        WHERE user_id = ?
        AND role = ?
        AND  EXISTS (
            SELECT 1 FROM classworks WHERE classworks.classroom_id = classroom_user.classroom_id 
             AND EXISTS  (
                SELECT 1 FROM submissions WHERE submissions.classwork_id =  classworks.id AND id= ?) 
                )'
        , [$user->id , 'teacher' , $submission->id]);
        
        $isTeacher = $submission->classwork->classroom->teachers()->where('id', $user->id)->exists();
        $isOwner = $submission->user_id == $user->id;

        if (!$isTeacher && !$isOwner) {
            abort(403);
        }

        // file function return file that we can see it in the browser,
        // but if we use storage download it's use just for download file without display it  
        return response()->file(storage_path('app/' . $submission->content));
    }
}
