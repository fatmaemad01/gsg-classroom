@extends('layouts.master')

@section ('title' , 'Create Classroom ')

@section('content')
    <div class="container mt-4">
        <h1 mb-3>Create Classrooms </h1>
        <form action="{{route('classroom.store')}}" method="post" enctype="multipart/form-data">
            {{-- This is multi way to define the token 
                
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{csrf_field()}} --}}
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Class Name">
                <label for="name">Class Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="section" id="section" placeholder="Section">
                <label for="section">Section</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                <label for="subject">Subject</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="room" id="room" placeholder="Class room">
                <label for="room">Room</label>
            </div>
            <div class="form-floating mb-3">
                <input type="file" class="form-control" name="cover_img" id="cover_img">
                <label for="cover_img">Cover Image</label>
            </div>
            <div class="form-floating mb-3">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endSection