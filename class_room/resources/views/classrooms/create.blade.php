@extends('layouts.master')

@section ('title' , 'Create Classroom ')

@section('content')
<div class="container p-5">
    <h1 mb-3>Create Classrooms </h1>

    {{-- way to print all errors
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
    @endforeach
    </ul>
</div>
@endif
--}}

<form action="{{route('classroom.store')}}" method="post" enctype="multipart/form-data">
    {{-- This is multi way to define the token 
                
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
    {{csrf_field()}} --}}
    @include ('classrooms._form' , [
    'button' => 'Create Classroom'
    ])
</form>
</div>
@endSection