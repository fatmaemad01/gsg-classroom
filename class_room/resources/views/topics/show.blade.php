<x-main-layout title="Topic">
    <x-nav />
    <div class="container m-5">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-1 mt-5">
                <a href="{{route('classrooms.classworks.index' , $topic->classroom_id)}}" class="text-success fw-bold" style="font-size: 15px;">
                    All Topics
                </a>
                <ul class="nav">
                    @foreach($classroom->topics as $topic)
                    <li class="nav-item mt-4">
                        <a href="{{ route('topics.show' , $topic->id) }}" class="text-secondary  pt-4 ">{{$topic->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-1"></div>
            <div class="col-8 p-2">
                @forelse($classworks as $group)
                <h3 class="text-success my-4"> {{$group->first()->topic->name}}</h3>
                <div class="card p-4 mb-4">

                    <div class="accordion accordion-flush " id="accordionFlushExample">
                        @foreach($group as $classwork)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$classwork->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class="fas fa-file-lines ms-2 me-3 text-success"></i> {{$classwork->title}}
                                </button>
                            </h2>
                            <div id="flush-collapse{{$classwork->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">{{$classwork->description}}</div>
                                <div class="actions d-flex justify-content-end mb-4 me-3">
                                    <a href="{{route('classrooms.classworks.edit' , [$topic->classroom_id , $classwork->id ])}}" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
                                    <a href="{{route('classrooms.classworks.show' , [$topic->classroom_id , $classwork->id ])}}" class="btn btn-outline-success ms-3 "><i class=" fas fa-eye"></i></a>

                                    <form action="{{route('classrooms.classworks.destroy',  [$topic->classroom_id , $classwork->id])}}" method="post" class="ms-3">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger "><i class="fas fa-trash"></i></button>
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