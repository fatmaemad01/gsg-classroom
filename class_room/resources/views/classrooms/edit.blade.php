@extends('layouts.layout')

@section('content')

<div class="container">
    <h1>Edit Classroom # {{$id}} </h1>
    <form action="{{route('classroom.update' , $classroom->id)}}" method="post">
            @method('patch')
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="name" placeholder="Class Name" value="{{$classroom->name}}">
                <label for="name">Class Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="section" id="section" placeholder="Section" value="{{$classroom->section}}">
                <label for="section">Section</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" value="{{$classroom->subject}}">
                <label for="subject">Subject</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="room" id="room" placeholder="Class room" value="{{$classroom->room}}">
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