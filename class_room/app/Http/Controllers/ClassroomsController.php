<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use PHPUnit\TextUI\Configuration\Merger;

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
        return view()->make('classrooms.create');
    }

    public function store(Request $request): RedirectResponse
    {

        // $data = $request->except('cover_img');
        // $data['code'] = Str::random(8);

        // Way to upload images 
        // if ($request->hasFile('cover_img')) {
        // $file = $request->file('cover_img');
        // $path = $file->store('/covers', 'public');  // path .. store at public disk
        // $request->merge([
        //     'cover_image_path' => $path,
        // ]);

        // another way to upload images
        if ($request->hasFile('cover_img')) {
            $file = $request->file('cover_img');
            $request->merge(['cover_image_path' =>  $this->upload($file)]);
        }


        $request->merge([
            'code' => Str::random(8),
        ]);

        $classroom = Classroom::create($request->all());

        return redirect()->route('classroom.index')->with('success', $classroom->name.' Created Successfully.');
    }

    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);

        $topics = Topic::where('classroom_id', '=', $classroom->id)->get();
        return View::make('classrooms.show')
            ->with([
                'id' => $id,
                'classroom' => $classroom,
                'topics' => $topics,
            ]);
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('classrooms.edit', [
            'classroom' => $classroom,
        ]);
    }


    public function update(Request $request, $id)
    {
        $classroom = Classroom::find($id);

        $data = $request->except('cover_img');

        $old_image = $classroom->cover_image_path;

        if ($request->hasFile('cover_img')) {
            $file = $request->file('cover_img');
            $data['cover_image_path'] = $this->upload($file);
        }

        $classroom->update($data);

        if ($old_image && $old_image != $classroom->cover_image_path) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('classroom.index')->with('success', $classroom->name.' Updated Successfully.');
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        if ($classroom->cover_image_path) {
            Storage::disk('public')->delete($classroom->cover_image_path);
        }

        return redirect()->route('classroom.index')
            ->with('success', 'Classroom deleted');
    }


    protected function upload(UploadedFile $file)
    {
        if ($file->isValid()) {
            return $data['cover_image_path'] =
                $file->store('covers', ['disk' => 'public']);
        } else {
            throw ValidationException::withMessages([
                'cover_img' => 'File Corrupted',
            ]);
        }
    }
}
