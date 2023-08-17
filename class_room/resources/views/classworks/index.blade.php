<x-main-layout :title="$classroom->name">
    <x-secondary-nav :id="$classroom->id" />


    <div class="container  mt-4">
        <div class="row">
            <div class="col-lg-1 m-5">
                <a href="{{route('classrooms.classworks.index' , $classroom->id)}}" class="text-success fw-bold" style="font-size: 15px;">
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
            <div class="col-lg-10">
                <div class="content m-5">
                    <div class="head d-flex justify-content-between mb-4 ">
                        <div class="dropdown">
                            <button style="border-radius: 50px;" class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-plus me-2"></i> Create
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('classrooms.classworks.create', [$classroom->id , 'type'=>'assignment'])}}">Assignment</a></li>
                                <li><a class="dropdown-item" href="{{route('classrooms.classworks.create', [$classroom->id , 'type'=>'material'])}}">Material</a></li>
                                <li><a class="dropdown-item" href="{{route('classrooms.classworks.create', [$classroom->id , 'type'=>'question'])}}">Question</a></li>
                            </ul>
                        </div>
                        <form action="{{URL::current()}}" method="get" class="d-flex justify-content-start">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search">
                            <button type="submit" class="btn btn-success ms-2"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    @forelse($classworks as $group)
                    <div class="card p-4 mb-4">
                        <h3 class="text-success"> {{$group->first()->topic->name}}</h3>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
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
                                        <a href="{{route('classrooms.classworks.edit' , [$classroom->id , $classwork->id ])}}" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('classrooms.classworks.show' , [$classroom->id , $classwork->id ])}}" class="btn btn-outline-success ms-3 "><i class=" fas fa-eye"></i></a>

                                        <form action="{{route('classrooms.classworks.destroy',  [$classroom->id , $classwork->id])}}" method="post" class="ms-3">
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