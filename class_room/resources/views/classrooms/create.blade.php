<x-main-layout title="{{ __('Create Classroom') }}">

    <h3 class="mb-2">{{ __('Create Classroom') }} </h3>
    <x-errors />

    <form action="{{ route('classroom.store') }}" method="post" enctype="multipart/form-data">
        {{-- This is multi way to define the token

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{csrf_field()}} --}}

        @include ('classrooms._form', [
            'button' => 'Create Classroom',
        ])
    </form>
</x-main-layout>
