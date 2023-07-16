@extends('layouts.master')

@section ('title' , 'Edit Classroom')

@section('content')


<div class="container p-5">
    <h1>Edit Classroom # {{$classroom->id}} </h1>
    <form action="{{route('classroom.update' , $classroom->id)}}" method="post" enctype="multipart/form-data">
        @method('patch')
        @include('classrooms._form' , [
        'button' => 'Update Classroom'
        ])
    </form>
</div>
@endSection