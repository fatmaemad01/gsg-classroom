<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Topic;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\TextUI\Configuration\Merger;
use Illuminate\Validation\ValidationException;

class ClassroomsController extends Controller
{
    // Actions 
    public function index(Request $request)
    {

        $classrooms = Classroom::orderBy('name', 'DESC')->get();
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
        // $rules =             [
        //     'code' => 'string',
        //     'name' => 'required|string|min:3|max:255',
        //     'section' => 'nullable|string|max:255',
        //     'subject' => 'nullable|string|max:255',
        //     'room' => 'nullable|string| max:255',
        //     'cover_img' => [
        //         'image',
        //         'nullable',
        //         Rule::dimensions([
        //             'min_width' => 1400,
        //             'min_height' => 1450,
        //         ])
        //     ],
        // ];

        // $message = [
        //     'required' => ':attribute Important',
        //     'required.name' => 'Name field is required!'
        // ];
        // $validated = $request->validate($rules , $message);

        $validated = $request->validated();  // validated function from the custom request, the validation happen dynamic   
        // another way to upload images
        if ($request->hasFile('cover_img')) {
            $file = $request->file('cover_img');

            $path = Classroom::uploadCoverImage($file);
            $validated['cover_image_path'] = $path;
        }
        $validated['code'] = Str::random(8);

        $classroom = Classroom::create($validated);

        return redirect()->route('classroom.index')->with('success', $classroom->name . ' Created Successfully.');
    }

    public function show(Classroom $classroom)
    {
        $topics = Topic::where('classroom_id', '=', $classroom->id)->get();
        return View::make('classrooms.show')
            ->with([
                // 'id' => $id,
                'classroom' => $classroom,
                'topics' => $topics,
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

        if ($classroom->cover_image_path) {
            Classroom::deleteCoverImage($classroom->cover_image_path);
        }

        return redirect()->route('classroom.index')
            ->with('success', 'Classroom deleted');
    }
}
