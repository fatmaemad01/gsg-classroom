<x-main-layout title="People">
    <x-secondary-nav>
        <li class="nav-item active">
            <a class="nav-link text-success" href="{{ route('classroom.show', $classroom->id) }}">
                Stream
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link text-success" href="{{ route('classrooms.classworks.index', $classroom->id) }}">
                Classworks
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link text-success" href="{{ route('classroom.people', $classroom->id) }}">
                People
            </a>
        </li>
    </x-secondary-nav>
    <x-alert name="success" id="success" />
    <x-alert name="error" id="error" class="alert-danger" />

    <div class="container mt-4 p-5">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="teacher mb-5">
                    <h2 class="text-success mb-1">{{ __('Teachers') }}</h2>
                    <hr class="text-success  mb-3 fw-bold">

                    @foreach ($classroom->teachers()->orderBy('name')->get() as $user)
                        <div class="row">
                            <div class="col-1">
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}" class="ms-4"
                                    alt="" height="35px" width="35px" style="border-radius: 50%" />
                            </div>
                            <div class="col-10">
                                <p class="text-secondary fw-bold mt-2 ms-4">{{ $user->name }}</p>
                            </div>
                            <div class="col-1">
                                <form action="{{ route('classroom.people.destroy', $classroom->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-outline-danger"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <hr class="text-secondary fw-bold">
                    @endforeach
                </div>

                <div class="students mb-5">
                    <h2 class="text-success">{{ __('Classmates') }}</h2>
                    <hr class="text-success mb-3 fw-bold">

                    @foreach ($classroom->students()->orderBy('name')->get() as $user)
                        <div class="row">
                            <div class="col-1">
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}" class="ms-4"
                                    alt="" height="35px" width="35px" style="border-radius: 50%" />
                            </div>
                            <div class="col-10">
                                <p class="text-secondary fw-bold mt-2 ms-4">{{ $user->name }}</p>
                            </div>
                            <div class="col-1">
                                <form action="{{ route('classroom.people.destroy', $classroom->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-outline-danger"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <hr class="text-secondary fw-bold">
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-main-layout>
