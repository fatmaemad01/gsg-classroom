<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Topic;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClassroomRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\TextUI\Configuration\Merger;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Validation\ValidationException;

class ClassroomsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Actions 
    public function index(Request $request)
    {

        $classrooms = Classroom::status('active')
            ->recent()
            ->orderBy('created_at', 'DESC')
            // ->withoutGlobalScope('user') here we can make this function to stop specific globalScope 
            // ->withoutGlobalScopes() here we can make this function to stop all globalScope 
            // ->withoutGlobalScope(UserClassroomScope::class) //here we can make this function to stop all globalScope 
            ->get();

        $success = session('success');
        return view('classrooms.index', compact('classrooms', 'success'));
    }

    public function create()
    {
        return view()->make('classrooms.create', [
            'classroom' => new Classroom(),
        ]);
    }


    public function store(ClassroomRequest $request): RedirectResponse
    {
        // validation
        $validated = $request->validated();

        // upload image
        if ($request->hasFile('cover_img')) {
            $file = $request->file('cover_img');

            $path = Classroom::uploadCoverImage($file);
            $validated['cover_image_path'] = $path;
        }

        // define the data that don't pass by request
        $validated['code'] = Str::random(8);

        // $validated['user_id'] = Auth::user()->id;
        // $request->user()->id;
        $validated['user_id'] = Auth::id();

        // this will stop auto commit يعني عمليات الداتا بيز بتكون غير معتمدة تلقائيا
        DB::beginTransaction();

        try {
            $classroom = Classroom::create($validated);

            // when any one create classroom be by default the teacher
            $classroom->join(Auth::id(), 'teacher');
            //   اذا تم تنفيذ كل العمليات بدون مشاكل يتم اعتمادها 
            DB::commit();
        } catch (Exception $e) {
            // اذا حصلت مشاكل في الادخال بيصير عنا تراجع عن جميع العمليات
            DB::rollBack();
            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
        return redirect()->route('classroom.index')->with('success', $classroom->name . ' Created Successfully.');
    }

    public function show(Classroom $classroom)
    {
        $topics = Topic::where('classroom_id', '=', $classroom->id)->get();

        $invitation_link = URL::signedRoute('classroom.join', [
            'classroom' => $classroom->id,
            'code' => $classroom->code,
        ]);

        return view('classrooms.show' , [
            'topics' => $topics,
            'classroom' => $classroom,
            'invitation_link' => $invitation_link,
        ]);
    }

    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', [
            'classroom' => $classroom,
        ]);
    }


    public function update(ClassroomRequest $request, Classroom $classroom)
    {

        $validated = $request->validated();


        $data = $request->except('cover_img');

        $old_image = $classroom->cover_image_path;

        if ($request->hasFile('cover_img')) {
            $file = $request->file('cover_img');

            $path = Classroom::uploadCoverImage($file);
            $validated['cover_image_path'] = $path;
        }

        $classroom->update($validated);

        if ($old_image && $old_image != $classroom->cover_image_path) {
            Classroom::deleteCoverImage($old_image);
        }

        return redirect()->route('classroom.index')
            ->with('success', $classroom->name . ' Updated Successfully.');
        // ->with('error', $classroom->name . ' Test  Successfully.');
    }


    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        // if ($classroom->cover_image_path) {
        //     Classroom::deleteCoverImage($classroom->cover_image_path);
        // }

        return redirect()->route('classroom.index')
            ->with('success', 'Classroom deleted');
    }

    public function trashed()
    {
        // orderby('created_at') = latest
        $classrooms = Classroom::onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('classrooms.trashed', compact('classrooms'));
    }

    public function restore($id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();

        return redirect()
            ->route('classroom.index')
            ->with('success', "Classroom $classroom->name Restored");
    }

    public function forceDelete($id)
    {
        $classroom = Classroom::withTrashed()->findOrFail($id);
        $classroom->forceDelete();

        $path  = $classroom->cover_image_path;
        Classroom::deleteCoverImage($path);

        return redirect()
            ->route('classroom.trashed')
            ->with('success', "Classroom $classroom->name Deleted forever!");
    }
}
