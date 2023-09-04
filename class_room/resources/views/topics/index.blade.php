<x-main-layout title="Topic">
    <x-secondary-nav :id="$classroom->id" />
    <div class="container m-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-1 mt-5">
                <a href="{{ route('topics.index', [$classroom->id]) }}" class="text-success fw-bold"
                    style="font-size: 15px;">
                    All Topics
                </a>
                <ul class="nav">
                    @foreach ($topics as $topic)
                        <li class="nav-item mt-4">
                            <a href="{{ route('topics.show', $topic->id) }}"
                                class="text-secondary  pt-4 ">{{ $topic->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-1"></div>
            <div class="col-8 ">
                @forelse($classworks as $group)
                    <div class="head d-flex justify-content-between mt-5">
                        <h3 class="text-success mx-4 "> {{ $group->first()->topic->name }}</h3>
                        <x-more isTopic="{{ true }}" :name="$group->first()->topic->name" :id="$group->first()->topic->id"
                            deleteRoute="{{ route('topics.destroy', $group->first()->topic->id) }}"
                            updateRoute="{{ route('topics.update', $group->first()->topic->id) }}" />
                    </div>
                    @foreach ($group as $classwork)
                        <hr style="margin-top: 5px" class="text-muted">
                        <div class="d-flex justify-content-between" style="font-size: 13px">
                            <a class=" d-flex col-10 " style="background-color: #fff"
                                href="{{ route('classrooms.classworks.show', [$classroom->id, $classwork->id]) }}">
                                <i class="fas fa-file-lines mx-4 "
                                    style="font-size: 22px; color:rgb(193, 196, 199)"></i>
                                <p class="text-secondary fw-bold" style="font-size: 15px">
                                    {{ $classwork->stream->content }}
                                </p>
                            </a>
                            <div class="ms-1">
                                <x-more :id="$classwork->id" :name="$classwork->title"
                                    deleteRoute="{{ route('classrooms.classworks.destroy', [$classwork->classroom_id, $classwork->id]) }}"
                                    updateRoute="{{ route('classrooms.classworks.update', [$classwork->classroom_id, $classwork->id]) }}">
                                    <h5 class="text-center m-3">Update {{ $classwork->title }}</h5>
                                    @include('classworks._form', [
                                        'type' => $classwork->type->value,
                                        'button' => 'Edit',
                                    ])
                                </x-more>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <p class="text-center fs-4">No classworks Found</p>
                @endforelse
            </div>
        </div>
    </div>
</x-main-layout>
