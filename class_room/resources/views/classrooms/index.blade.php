@extends('layouts.layout')

@section('content')
<div class="container mt-4 ">
    <div class="services mb-3">
        <i class="fa-solid fa-list-check " style="color: #4285f4"></i>
        <a href="#" class="ps-1">To do</a>

        <i class="fa-regular fa-rectangle-list ms-3" style="color: #4285f4"></i>
        <a href="#" class="ps-1">To review</a>

        <i class="fa-regular fa-calendar ms-3" style="color: #4285f4"></i>
        <a href="#" class="ps-1">Calender</a>
    </div>

    <div class="container">
        <div class="classrooms">
            <div class="row">
                @foreach($classrooms as $classroom)
                <div class="col-md-3 me-3 mt-3 card" style="width: 20rem">
                    <img src="" class="card-img-top" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title">{{$classroom->name}}</h5>
                        <p class="card-text">{{ $classroom->section}}, {{ $classroom->subject}}</p>
                        <div class="actions d-flex justify-content-end">
                            <a href="{{route('classroom.show' , $classroom->id)}}" class="btn"><i class="fa-solid fa-eye pe-2"></i></a>
                            <a href="{{route('classroom.edit' , $classroom->id)}}" class="btn"><i class="fa-regular fa-pen-to-square pe-2"></i></a>

                            <form action="{{route('classroom.destroy' , $classroom->id)}}"  method="post">
                               @method('delete') 
                               @csrf
                            
                                <button type="submit" class="btn" ><i class="fa-solid fa-trash " style="color:tomato"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endSection