@extends('layouts.layout')

@section('content')

<div class="container mt-4">
    <div class="head d-flex justify-content-between ">
        <div class="title">
            <h1 mb-3>{{$classroom -> name}} (#{{$classroom->id}}) </h1>
            <h3>{{$classroom->section}}</h3>
        </div>
        <div class="new">
            <a href="{{route('topics.create' , $classroom->id)}}" class="btn btn-primary mt-3">Add Topics</a>
        </div>
    </div>
    <div class="col">
        <div class="row-md-3">
            @foreach($topics as $topic)
            <div class="card mt-3 p-3">
                <h5>{{$topic->name}}</h5>
                <div class="actions d-flex justify-content-end">
                    <a href="{{route('topics.edit' , $topic->id)}}" class="btn btn-outline-primary me-3">update</a>
                    <form action="{{route('topics.destroy', $topic->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endSection