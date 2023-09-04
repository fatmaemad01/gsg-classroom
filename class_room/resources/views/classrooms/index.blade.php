<x-main-layout title="{{__('classrooms')}}">
    <x-nav />


    <div class="container mt-4 ">
        <x-alert name="success" class="alert-success" />

        <ul id="classrooms">
        </ul>
        <div class="header d-flex justify-content-between">
            <h3>{{__('Classrooms')}}</h3>

        </div>
        {{-- use this tag to apply html tag
                  {!! __('pagination.next') !!}
         --}}
        <div class="container">
            <div class="classrooms m-3">
                <div class="row ms-3">
                    @foreach($classrooms as $classroom)
                    <x-card :username="$classroom->teachers->first()->name" :show="$classroom->url" :name="$classroom->name" :id="$classroom->id" :section="$classroom->section" :subject="$classroom->subject" :room="$classroom->room" :cover_image_path="$classroom->cover_image_path" />
                    @endforeach
                    <div class="mt-4 d-flex justify-content-start">
                        {{ $classrooms->withQueryString()->appends([''=>''])->links() }}

                    </div>
                </div>
            </div>
        </div>

@push('scripts')
<script>
        fetch('/api/v1/classrooms')
        .then(res => res.json() )
        .then(json => {
           let ul = document.getElementById('classrooms');
           for(let i in json){
            ul.innerHTML += `<li>${json.data[i].name}</li>`;
           }
        })
    </script>
@endpush
</x-main-layout>
