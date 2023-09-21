<x-main-layout title="{{__('Update Topic')}}">
    <div class="container mt-4">
        <h2 mb-3>{{__('Update Topic')}} </h2>

        <form action="{{route('topics.update' , $topic->id)}}" method="POST">
            @method('put')
            @include('topics._form' , [
            'button' => 'Update Topic'])
        </form>

    </div>
</x-main-layout>