<x-main-layout title="Edit Topic">
    <div class="container mt-4">
        <h2 mb-3>Edit Topic </h2>

        <form action="{{route('topics.update' , $topic->id)}}" method="POST">
            @method('put')
            @include('topics._form' , [
            'button' => 'Update Topic'])
        </form>

    </div>
</x-main-layout>