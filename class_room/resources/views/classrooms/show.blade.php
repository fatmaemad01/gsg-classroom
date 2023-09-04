<x-main-layout :title="$classroom->name">
    <x-secondary-nav :id="$classroom->id">
        <div class="container  m-4">
            <div class="content m-5">
                <div class="image position-relative">
                    @if ($classroom->cover_image_path)
                        <img src="{{ asset('storage/' . $classroom->cover_image_path) }}" class="img-fluid rounded"
                            alt="x..." height="210" width="100%" />
                    @else
                        <img src="{{ asset('./img/1.jpg') }}" class="" alt="..." height="210"
                            width="21rem" />
                    @endif
                </div>
                <div class="head d-flex justify-content-between ">
                    <h1 class="mb-3  position-absolute text-white" style="top: 260px; left: 260px;">
                        {{ $classroom->name }} </h1>

                    <h3 class="mb-3  position-absolute " style="top: 143px; right: 170px;"><a
                            href="{{ route('classroom.edit', $classroom->id) }}" data-bs-toggle="modal"
                            data-bs-target="#room{{ $classroom->id }}" class="text-white"><i
                                class="fas fa-gear"></i></a></h3>
                </div>
                <div class="modal fade" id="room{{ $classroom->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog row modal-xl modal-dialog-centered">
                        <div class="modal-content ">
                            <h5 class="text-center mt-4 mb-2">Update {{ $classroom->name }}</h5>
                            <form action="{{ route('classroom.update', $classroom->id) }}" method="post"
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
                <div class="row">
                    <div class="col-md-2 mt-3">
                        <div class="new mt-3 ">
                            <a href="{{ route('topics.create', $classroom->id) }}" style="width: 100%;"
                                class="btn btn-success ">{{ __('Add Topic') }}</a>
                        </div>

                        <div class="card mt-3 p-3 ">
                            <div class="d-flex justify-content-between">
                                <h6 class="mt-2"><b>{{ __('Join Link') }}</b> </h6>
                                <span id="textToCopy" style="display: none;">{{ $invitation_link }}</span>
                                <button onclick="copyText()" class="ms-1 btn "><i class="fas fa-copy"></i></button>

                            </div>
                        </div>
                        <div class="card mt-3 p-3">
                            <h6 class="fw-light">{{ __('Class code') }}</h6>
                            <h5>{{ $classroom->code }}</h5>
                        </div>
                        <div class="card mt-3 p-3">
                            <h6>{{ __('Upcoming') }}</h6>
                            <p class="fw-light">{{ __('no work due in soon') }}</p>
                            <a href="#" class="fw-light">{{ __('View All') }}</a>
                        </div>

                    </div>
                    <div class="col">
                        <div class="row-md-3">
                            <div class="shadow p-3 mb-5 bg-body rounded mt-5 p-3" id="initialDiv" style="height: 80px;">
                                <div class="actions d-flex justify-content-between">
                                    <div class="d-flex justify-content-start ">
                                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                                            class="me-4 ms-3" alt="" height="42px" width="42px"
                                            style="border-radius: 50%" />
                                        <p class="pt-3" style="font-size: 14px; color:#b1b1b1">
                                            {{ __('Announce something to your class') }}</p>
                                    </div>
                                    <a href="#" class="btn" onclick="toggleForm()">
                                        <i class="fa-solid fa-right-left pt-2"></i>
                                    </a>
                                </div>
                            </div>
                            <div id="commentForm"
                                class="hidden-form shadow p-4 mb-5 bg-body rounded mt-5 p-3 d-none justify-content-start">
                                <div class="row-12">
                                    <form action="{{ route('posts.store', $classroom->id) }}" method="post"
                                        class="hidden-form d-flex justify-content-start">
                                        @csrf
                                        <div class="col-9">
                                            <x-form.form-floating name="content"
                                                placeholder="Announce something to your class">
                                                <x-form.textarea name="content"
                                                    placeholder="Announce something to your class">
                                                </x-form.textarea>
                                            </x-form.form-floating>
                                        </div>
                                        <div class="col-3 ms-3">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    All Students
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    @foreach ($classroom->students as $student)
                                                        <li class="dropdown-item">
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="students[]"
                                                                    type="checkbox" value="{{ $student->id }}"
                                                                    id="std--{{ $student->id }}" checked>
                                                                <label class="form-check-label"
                                                                    for="std--{{ $student->id }}">
                                                                    {{ $student->name }}
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <button type="submit" class="btn btn-success mt-3">Post</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @foreach ($classroom->streams as $stream)
                            <a href="{{ $stream->link }}">
                                <div class="card p-4 mt-4">
                                    <div class="d-flex justify-content-start">
                                        <div>
                                            <i class="fas fa-file-lines mt-2 me-4 ms-2 text-success"
                                                style="font-size: 26px;"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark"> {{ $stream->content }}
                                                <p style="font-size: 14px;" class="text-secondary fw-normal mt-2">
                                                    {{ $stream->created_at->format('F j, Y') }}
                                                </p>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                function copyText() {
                    const text = document.getElementById('textToCopy').innerText;

                    const tempInput = document.createElement('input');
                    tempInput.type = 'text';
                    tempInput.value = text;

                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);
                }

                function toggleForm() {
                    var form = document.getElementById('commentForm');
                    form.classList.toggle('d-none'); // Toggle the 'd-none' class

                    var initialDiv = document.getElementById('initialDiv');
                    initialDiv.classList.toggle('d-none');
                }
            </script>
        @endpush
    </x-secondary-nav>
</x-main-layout>
