<x-main-layout title="{{__('Update Classroom')}}">
    <div class="container p-5">
        <h1>{{__('Update Classroom')}} # {{$classroom->id}} </h1>
        <form action="{{route('classroom.update' , $classroom->id)}}" method="post" enctype="multipart/form-data">
            @method('patch')
            @include('classrooms._form' , [
            'button' => 'Update Classroom'
            ])
        </form>
    </div>
</x-main-layout>
