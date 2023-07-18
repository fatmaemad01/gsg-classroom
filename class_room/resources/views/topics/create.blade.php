<x-main-layout title="Create Topic">

    <div class="container mt-4">
        <h2 mb-3>Create Topic </h2>
        <form action="{{route('topics.store' , $classroom->id)}}" method="POST">

            @include('topics._form' , [
            'button' => 'Create Topic'])
        </form>

    </div>
</x-main-layout>