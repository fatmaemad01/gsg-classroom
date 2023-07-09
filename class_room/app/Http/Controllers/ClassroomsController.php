<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ClassroomsController extends Controller
{
    // Actions 
    public function index(Request $request) : RedirectResponse
    {

        // return redirect('/');
        // return redirect()->route('home');
        // return Redirect::route('home');
        return Redirect::away('https:://google.com');

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

    public function show($id, $edit = false)
    {
        return View::make('classrooms.show')
            ->with([
                'id' => $id,
                'edit' => $edit
            ]);
    }

    public function edit($id)
    {
        return view('classrooms.edit', compact('id'));
    }
}
