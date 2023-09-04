<x-main-layout :title="$classroom->name">
    <x-secondary-nav :id="$classroom->id" />
    <div class="container  mt-4">
        <div class="row">
            <div class="col-lg-1 m-5">
                <a href="{{ route('topics.index', $classroom->id) }}" class="text-success fw-bold"
                    style="font-size: 15px;">
                    {{ __('All Topics') }}
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
            <div class="col-lg-9">
                <div class="content m-5">
                    <div class="head d-flex justify-content-between mb-4 ">
                        @can('create', ['App\Models\Classwork', $classroom])
                            <div class="dropdown">
                                <button style="border-radius: 50px;" class="btn btn-success dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-plus me-2"></i> {{ __('Create') }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item"
                                            href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'assignment']) }}">{{ __('Assignment') }}</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'material']) }}">{{ __('Material') }}</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'question']) }}">{{ __('Question') }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endCan
                        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-start">
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="{{ __('Search') }}">
                            <button type="submit" class="btn btn-success ms-2"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    @forelse($classworks as $group)
                        <div class="card p-4 mb-4">
                            <h3 class="text-success"> {{ $group->first()->topic?->name }}</h3>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                @foreach ($group as $classwork)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $classwork->id }}"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                <i class="fas fa-file-lines ms-2 me-3 text-success"></i>
                                                {{ $classwork->title }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $classwork->id }}"
                                            class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {!! $classwork->description !!}</div>

                                                    @if ($classwork->type->value == 'assignment')
                                                        <div class="col-md-6 row">
                                                            <div class="col-md-4">
                                                                <div class="fs-3"> {{ $classwork->users_count }}
                                                                </div>
                                                                <div class="text-muted">{{ __('Assigned') }}</div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="fs-3"> {{ $classwork->turnedin_count }}
                                                                </div>
                                                                <div class="text-muted">{{ __('Turned-in') }}</div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="fs-3"> {{ $classwork->graded_count }}
                                                                </div>
                                                                <div class="text-muted">{{ __('Graded') }}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="text-muted">
                                            <div class="actions d-flex justify-content-between ">
                                                <a href="{{ route('classrooms.classworks.show', [$classroom->id, $classwork->id]) }}"
                                                    class=" text-success ms-3 mt-2">View instructions</a>
                                                <div class="d-flex justify-content-between mt-1 me-3">
                                                    @can('update', ['App\Models\Classwork', $classwork])
                                                        <a href="{{ route('classrooms.classworks.edit', [$classroom->id, $classwork->id]) }}"
                                                            class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete', ['App\Models\Classwork', $classwork])
                                                        <form
                                                            action="{{ route('classrooms.classworks.destroy', [$classroom->id, $classwork->id]) }}"
                                                            method="post" class="ms-3">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-outline-danger "><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    @endcan
                                                </div>
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

    @push('scripts')
        <script>
            const classroomId = "{{ $classwork->classroom_id }}"
        </script>
        @vite('resources/js/app.js')
    @endPush
</x-main-layout>
