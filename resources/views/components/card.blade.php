@props(['name', 'section', 'subject', 'room', 'id', 'cover_image_path', 'show', 'username', 'classroom'])
<div class="col-md-3 me-4 mt-3 p-0 card" style="width: 23rem">
    @if ($cover_image_path)
        <img src="storage/{{ $cover_image_path }}" class="card-img-top m-0" alt="..." height="160" width="21rem" />
    @else
        <img src="{{ asset('./img/1.jpg') }}" class="card-img-top" alt="..." height="160" width="21rem" />
    @endif
    <div class="card-body ">
        <a href="{{ route('classroom.show', $id) }}" class="text-white">
            <h5 class="card-title ps-1" style="position:relative; top:-150px; font-size:22px">{{ $name }}</h5>
            <p class="card-text ps-1 text-white" style="position:relative; top:-155px;">{{ $username }}</p>
        </a>
    </div>
    <hr class="text-muted">
    {{-- @if ($student) --}}
    {{-- @elseif ($teacher) --}}

        <div class="actions d-flex justify-content-end">
            <a href="{{ $show }}" class="btn"><i class="fa fa-eye pe-2" style="font-size:20px"></i></a>

            <a href="{{ route('classroom.edit', $id) }}" data-bs-toggle="modal"
                data-bs-target="#room{{ $id }}" class="btn btn-rounded-info"><i
                    class="fa fa-edit pe-2" style="font-size:20px; color:"></i></a>
            <x-delete name="classroom.destroy" :id="$id" />
        </div>


        <div class="modal fade" id="room{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog row modal-xl modal-dialog-centered">
                <div class="modal-content ">
                    <h5 class="text-center mt-4 mb-2">Update {{ $name }}</h5>
                    <form action="{{ route('classroom.update', $id) }}" method="post"
                        enctype="multipart/form-data" class="hidden-form d-flex justify-content-start">
                        @csrf
                        @method('patch')
                        <div class="modal-body row">
                            @include('classrooms._form', [
                                'button' => 'Update Classroom',
                            ])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- @endif --}}
</div>
