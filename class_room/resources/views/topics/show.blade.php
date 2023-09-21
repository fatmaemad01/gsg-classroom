<x-main-layout title="Topic">
    <x-secondary-nav>
        <li class="nav-item active">
            <a class="nav-link text-success" href="{{ route('classroom.show', $classroom->id) }}">
                Stream
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link text-success" href="{{ route('classrooms.classworks.index', $classroom->id) }}">
                Classworks
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link text-success" href="{{ route('classroom.people', $classroom->id) }}">
                People
            </a>
        </li>
    </x-secondary-nav>
    <div class="">
        <div class="row">
            {{-- <div class="col-1"></div> --}}
            <div class="col-1 ms-3 mt-5">
                <a href="{{ route('topics.index', [$classroom->id ]) }}" class="text-success fw-bold"
                    style="font-size: 15px;">
                    All Topics
                </a>

                <ul class="nav">
                    @foreach ($classroom->topics as $topic)
                        <li class="nav-item mt-4">
                            <a href="{{ route('topics.show', $topic->id) }}"
                                class="text-secondary  pt-4 ">{{ $topic->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-1"></div>
            <div class="col-8 p-2">
                @forelse($classworks as $group)
                    <div class="head d-flex justify-content-between my-4">
                        <h3 class="text-success "> {{ $group->first()->topic->name }}</h3>
                        <x-more isTopic="{{ true }}" :name="$group->first()->topic->name"
                            :id="$group->first()->topic->id"
                            deleteRoute="{{ route('topics.destroy', $group->first()->topic->id) }}"
                            updateRoute="{{ route('topics.update', $group->first()->topic->id) }}" />
                    </div>
                    @foreach ($group as $classwork)
                        <div class="card mt-4" style="font-size: 13px">
                            {{-- <x-more :name="$classwork->name"
                                        deleteRoute="{{ route('classrooms.classworks.destroy', [$classwork->classroom_id, $classwork->id]) }}"
                                        updateRoute="{{ route('classrooms.classworks.update', [$classwork->classroom_id, $classwork->id]) }}" /> --}}

                            <a class="card-header d-flex  jsutify-content-between mt-2 " style="background-color: #fff"
                                href="{{ route('classrooms.classworks.show', [$classwork->classroom_id, $classwork->id]) }}">
                                <i class="fas fa-file-lines mx-2 mt-1 text-success"></i>
                                <p class="text-secondary fw-bold" style="font-size: 15px">
                                    {{ $classwork->stream->content }}
                                </p>
                            </a>
                            <div class="card-body" style="font-size: 13px">
                                <div class="head text-muted mb-2">
                                    Posted {{ $classwork->published_at->format('F j, Y') }}

                                    {{-- for stident <span>{{ $classwork->status }}</span> --}}
                                </div>
                                {!! $classwork->description !!}
                            </div>
                            <div class="card-footer text-muted" style="background-color: #fff">
                                <div class="row mt-2">
                                    <form action="{{ route('comments.store') }}" method="post"
                                        class="d-flex justify-content-start">
                                        <div class="col-lg-1">
                                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                                                class="me-4 ms-3" alt="" height="30px" width="30px"
                                                style="border-radius: 50%" />
                                        </div>
                                        <div class="col-lg-10">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $classwork->id }}">
                                            <input type="hidden" name="type" value="classwork">
                                            <x-form.input name="content" style="font-size: 13px; border-radius:30px"
                                                placeholder="{{ __('Add a class comment') }}">
                                            </x-form.input>
                                        </div>
                                        <div class="col-lg-1 ms-1">
                                            <button type="submit" class="btn"><i class="fas fa-paper-plane"
                                                    style="font-size: 14px"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    @empty
        <p class="text-center fs-4">No classworks Found</p>
        @endforelse
    </div>
    </div>
    </div>
    </div>
</x-main-layout>
