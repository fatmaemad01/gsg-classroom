@extends('layouts.master')

@section ('title' , 'Classroom details')

@section('content')

<div class="container  mt-4">
    <div class="content m-5">
        <div class="image position-relative">
            @if($classroom->cover_image_path)
            <img src="{{ asset('storage/'.$classroom->cover_image_path)}}" class="img-fluid rounded" alt="x..." height="210" width="100%" />
            @else
            <img src="{{asset('./img/1.jpg')}}" class="" alt="..." height="210" width="21rem" />
            @endif
        </div>
        <div class="head d-flex justify-content-between ">
            <h2 class="mb-3  position-absolute text-white" style="top: 319px; left: 197px;">{{$classroom -> name}} (#{{$classroom->id}}) </h2>
        </div>


        <div class="row">
            <div class="col-md-2">
                <div class="new mt-3 ">
                    <a href="{{route('topics.create' , $classroom->id )}}" class="btn btn-primary ">Add Topics</a>
                </div>
                <div class="card mt-3 p-3">

                    <h6 class="fw-light">Class code</h6>
                    <h5>{{$classroom->code}}</h5>
                </div>
                <div class="card mt-3 p-3">
                    <h6>Upcoming</h6>
                    <p class="fw-light">no work due in soon</p>
                    <a href="#" class="fw-light">View All</a>
                </div>

            </div>
            <div class="col">
                <div class="row-md-3">
                    @foreach($topics as $topic)
                    <div class="card mt-3 p-3">
                        <h5 class="text-capitalize">{{$topic->name}}</h5>
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

    </div>
</div>
@endSection