<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\TextUI\Configuration\Merger;

class ClassroomsController extends Controller
{
    // Actions 
    public function index(Request $request)
    {

        $classrooms = Classroom::orderBy('name', 'DESC')->get();
        // dd($classroom);
        // return redirect('/');
        // return redirect()->route('home');
        // return Redirect::route('home');
        return view('classrooms.index', compact('classrooms'));

        // return response: view, redirect, json-data, file, string
        // return view('classrooms.index', [
        //     'name' => 'Fatima ',
        //     'title' => 'web developer',
        // ]);
    }

    public function create()
    {
        return view()->make('classrooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Method 1
        // $classroom = new Classroom();
        // $classroom->name = $request->post('name'); 
        // $classroom->section = $request->post('section'); 
        // $classroom->subject = $request->post('subject'); 
        // $classroom->room = $request->post('room'); 
        // $classroom->code = Str::random(8);
        // $classroom->save();

        // Method 2 : Mass assignment

        // $data = $request->all();
        // $data ['code'] = Str::random(8);

        $request->merge([
            'code' => Str::random(8),
        ]);
        // First Mass way:
        $classroom = Classroom::create($request->all());

        // Second Mass way:
        // $classroom = new Classroom($request->all());
        // $classroom->save();

        // Third mass way
        // $classroom = new Classroom();
        // $classroom->fill($request->all())->save();
        // $classroom->forceFill($request->all())->save();

        return redirect()->route('classroom.index');
    }

    public function show(string $id)
    {
        // $classroom = Classroom::where('id','=',$id)->first();
        $classroom = Classroom::findOrFail($id);
        $topics = Topic::where('classroom_id', '=', $id)->get();
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
            'id' => $id,
            'classroom' => $classroom,
        ]);
    }


    public function update(Request $request, $id)
    {

        $classroom = Classroom::findOrFail($id);
        // traditional way: 
        // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->save();

        // Mass assignment
        // first way
        $classroom->update($request->all());
        // second way
        // $classroom->fill($request->all())->save();

        return Redirect::route('classroom.index');
    }

    public function destroy($id)
    {
        // first way
        // Classroom::where('id','=',$id)->delete();

        // second way
        // $classroom = Classroom::find($id);
        // $classroom->delete();

        // Third way
        Classroom::destroy($id);

        return redirect()->route('classroom.index');
        
    }
}
