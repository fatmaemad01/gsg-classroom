<x-main-layout title="Create Classwork">
    {{-- <x-secondary-nav :id="$classroom->id" /> --}}
    <x-errors/>
    <div class="container mt-5">
        <form action="{{route('classrooms.classworks.store' , [$classroom->id , 'type'=>$type])}}" method="post">
            @csrf
            <div class="row">
                <h3>{{__('Create')}} {{__($type)}}</h3>


                @include('classworks._form' , [
                    'button' => 'create'])
            </div>
        </form>
    </div>
</x-main-layout>
