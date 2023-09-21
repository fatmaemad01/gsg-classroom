<x-main-layout title="{{__('Create Topic')}}">
    <x-secondary-nav>
        <li class="nav-item active">
            <a class="nav-link text-success" href="{{ route('classroom.show', $classroom->id) }}">
                Stream
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link text-success" href="{{ route('classrooms.classworks.index', $classroom->id) }}">
                Classworks
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link text-success" href="{{ route('classroom.people', $classroom->id) }}">
                People
            </a>
        </li>
    </x-secondary-nav>
    <div class="container mt-4">
        <h2 mb-3>{{__('Create Topic')}} </h2>
        <form action="{{route('topics.store' , $classroom->id)}}" method="POST">

            @include('topics._form' , [
            'button' => 'Create Topic'])
        </form>

    </div>
</x-main-layout>
