@props([
    'deleteRoute' => '',
    'updateRoute' => '',
    'name' => '',
    'id' => '',
    'isTopic' => false,
])
<div class="dropstart">
    <button class="btn " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <span jsslot="" class="MhXXcc oJeWuf"><span class="Lw7GHd snByac"><svg focusable="false" width="24"
                    height="24" viewBox="0 0 24 24" class=" NMm5M">
                    <path
                        d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                    </path>
                </svg></span></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#1{{ $id }}"
                href="#">Delete</a>
        </li>
        @if ($isTopic)
            <li><a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#2{{ $id }}"
                    href="#">Edit</a>
            </li>
        @else
            <li><a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#3{{ $id }}"
                    href="#">Edit</a>
            </li>
        @endif
        <li><a class="dropdown-item" href="#">Copy Link</a></li>
    </ul>
</div>

<div class="modal fade" id="2{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ $updateRoute }}" method="post" class="hidden-form d-flex justify-content-start">
                @csrf
                @method('put')
                <div class="modal-body" style="width: 50%">
                    <h6 class="modal-title" id="exampleModalLabel" class="mb-2">Edit {{ $name }}?</h6>
                    @csrf
                    <x-form.form-floating name="name" placeholder="Name" class="mt-3">
                        <x-form.input name="name" :value="$name" placeholder="Name" />
                    </x-form.form-floating>
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="1{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ $deleteRoute }}" method="post" class="hidden-form d-flex justify-content-start">
                @csrf
                @method('delete')
                <div class="modal-body" style="width: 50%">
                    <h6 class="modal-title" id="exampleModalLabel" class="mb-2">Delete {{ $name }}?</h6>
                    <p class="text-muted mt-3">Comments will also be deleted</p>
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="3{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog row modal-xl modal-dialog-centered">
        <div class="modal-content ">
            <form action="{{ $updateRoute }}" method="post" class="hidden-form d-flex justify-content-start">
                @csrf
                @method('put')
                <div class="modal-body row">
                    {{ $slot }}
                </div>
            </form>
        </div>
    </div>
</div>
