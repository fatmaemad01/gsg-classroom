<x-main-layout title="Join">
    <div class="d-flex justify-content-center vh100">
        <form class="border p-5" action="{{route('classroom.join' , $classroom->id)}}" method="post">
        <h2>{{$classroom->name}}</h2>
        @csrf
        <button type="submit" class="btn btn-primary">{{__('Join')}}</button>
    </form>
    </div>

</x-main-layout>
