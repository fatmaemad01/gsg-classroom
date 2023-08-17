<x-main-layout title="Edit Classwork">
    <x-secondary-nav :id="$classroom->id" />

    <div class="container mt-5">
        <h3>Edit {{$classwork->title}}</h3>
        <form action="{{route('classrooms.classworks.update' , [$classroom->id , $classwork->id ,'type'=>$type])}}" method="post">
            <div class="row">
                @method('patch')
                @csrf
                @include('classworks._form' , [
                'button' => 'Edit'
                ])
            </div>
        </form>
    </div>
</x-main-layout>