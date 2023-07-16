@extends('layouts.master')

@section ('title' , 'Edit topic')

@section('content')
<div class="container mt-4">
    <h2 mb-3>Edit Topic </h2>

    <form action="{{route('topics.update' , $topic->id)}}" method="POST">
        @method('put')
        @include('topics._form' , [
        'button' => 'Update Topic'])
    </form>

</div>
@endSection