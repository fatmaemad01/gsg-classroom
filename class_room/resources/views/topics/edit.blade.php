@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h2 mb-3>Edit Topic </h2>

    <form action="{{route('topics.update' , $topic->id)}}" method="POST">
        @method('put')
        @csrf
        <div class="form-floating mt-3 mb-3 ">
            <input type="text" name="name" id="name" value="{{$topic->name}}" class="form-control">
            <label for="name" class="label-control">Topic Name:</label>
        </div>
        <div class="form-floating mb-3">
            <button type="submit" class="btn btn-primary">Edit Topic</button>
        </div>
    </form>

</div>
@endSection