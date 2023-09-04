<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
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

    public function __construct()
    {
        // $this->authorize(Classroom::class);
    }

    public function index(Request $request)
    {
        $this->authorize('view-any', Classroom::class);

        $classrooms = Classroom::status('active')
            ->recent()
            // ->get();
            // ->paginate(3);
            ->simplePaginate(3);

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
        $validated = $request->validated();

        // upload image
        if ($request->hasFile('cover_img')) {
            $file = $request->file('cover_img');

            $path = Classroom::uploadCoverImage($file);
            $validated['cover_image_path'] = $path;
        }

        // this will stop auto commit in database
        DB::beginTransaction();

        try {
            $classroom = Classroom::create($validated);
            // when any one create classroom be by default the teacher
            $classroom->join(Auth::id(), 'teacher');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }

        return redirect()->route('classroom.index')->with('success', $classroom->name . __('Created Successfully.'));
    }


    public function show(Classroom $classroom, Post $post)
    {
        $classworks = $classroom->classworks;

        $posts  = $classroom->posts;

        $post->load('comments.user');

        $invitation_link = URL::signedRoute('classroom.join', [
            'classroom' => $classroom->id,
            'code' => $classroom->code,

        ]);

        return view('classrooms.show', [
            'classworks' => $classworks,
            'classroom' => $classroom,
            'invitation_link' => $invitation_link,
            'posts' => $posts,
            'post' => $post,
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
            ->with('success', $classroom->name . __(' Updated Successfully.'));
    }


    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('classroom.index')
            ->with('success', __('Classroom deleted'));
    }


    public function trashed()
    {
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
            ->with('success', __("Classroom $classroom->name Restored"));
    }


    public function forceDelete($id)
    {
        $classroom = Classroom::withTrashed()->findOrFail($id);
        $classroom->forceDelete();

        // image will deleted by event
        return redirect()
            ->route('classroom.trashed')
            ->with('success', __("Classroom $classroom->name Deleted forever!"));
    }
}
