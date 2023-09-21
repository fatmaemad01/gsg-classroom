<x-main-layout title="Trashed Classrooms"> <x-alert name="success" id="success" class="alert-success" />
    <x-secondary-nav>
        <li class="nav-item active">
            <a class="nav-link">
                <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-start">
                    <input type="text" name="search" id="search" class="form-control"
                        placeholder="{{ __('Search') }}">
                    <button type="submit" class="btn btn-success ms-2"><i class="fa fa-search"></i></button>
                </form>
            </a>
        </li>
    </x-secondary-nav>
    <div class="classrooms m-3">
        <h3>{{ __('Archived Classrooms') }}</h3>
        <div class="row ">
            @foreach ($classrooms as $classroom)
                <div class="col-md-3 me-4 mt-3 p-0 card" style="width: 23rem">
                    @if ($classroom->cover_image_path)
                        <img src="{{ asset('storage/' . $classroom->cover_image_path) }}" class="card-img-top m-0"
                            alt="..." height="160" width="21rem" />
                    @else
                        <img src="{{ asset('./img/1.jpg') }}" class="card-img-top" alt="..." height="160"
                            width="21rem" />
                    @endif
                    <div class="card-body ">
                        <h5 class="card-title ps-1">{{ $classroom->name }}</h5>
                        <p class="card-text ps-1">{{ $classroom->section }}, {{ $classroom->subject }}</p>
                        <div class="actions d-flex justify-content-end">
                            <form action="{{ route('classroom.restore', $classroom->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn"><i class="fa fa-share text-success"></i></button>
                            </form>
                            <form action="{{ route('classroom.forceDelete', $classroom->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn"><i class="fa fa-trash pe-2"
                                        style="color:tomato"></i></button>
                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</x-main-layout>
