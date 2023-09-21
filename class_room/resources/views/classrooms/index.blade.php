<x-main-layout title="{{ __('classrooms') }}">
    <x-secondary-nav>
        <li class="nav-item active">
            <a class="nav-link">
                <x-user-notification-menu></x-user-notification-menu>
            </a>
        </li>
    </x-secondary-nav>
    <x-alert name="success" class="alert-success" />
    <ul id="classrooms">
    </ul>

    {{-- use this tag to apply html tag
                  {!! __('pagination.next') !!}
         --}}
    <div class="row">
        @foreach ($classrooms as $classroom)
            <x-card :classroom="$classroom" :username="$classroom->teachers->first()->name" :show="$classroom->url" :name="$classroom->name" :id="$classroom->id"
                :section="$classroom->section" :subject="$classroom->subject" :room="$classroom->room" :cover_image_path="$classroom->cover_image_path" />
        @endforeach
        <div class="mt-4 d-flex justify-content-start">
            {{ $classrooms->withQueryString()->appends(['' => ''])->links() }}

        </div>
    </div>

    @push('scripts')
        <script>
            fetch('/api/v1/classrooms')
                .then(res => res.json())
                .then(json => {
                    let ul = document.getElemenById('classrooms');
                    for (let i in json.data) {
                        ul.innerHTML += `<li>${json.data[i].name}</li>`;
                    }
                })
        </script>
    @endpush
</x-main-layout>
