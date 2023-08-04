<x-main-layout :title="$classroom->name">   
     <x-secondary-nav :id="$classroom->id" />

    
    <div class="container  mt-4">
        <div class="content m-5">

            <div class="head d-flex justify-content-between mb-4 ">
                <h2 class="mb-3 text-black">{{$classroom -> name}} #{{$classroom->id}} </h2>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-plus me-2"></i> Create
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{route('classrooms.classworks.create', [$classroom->id , 'type'=>'assignment'])}}">Assignment</a></li>
                        <li><a class="dropdown-item" href="{{route('classrooms.classworks.create', [$classroom->id , 'type'=>'material'])}}">Material</a></li>
                        <li><a class="dropdown-item" href="{{route('classrooms.classworks.create', [$classroom->id , 'type'=>'question'])}}">Question</a></li>
                    </ul>
                </div>
            </div>


            @forelse($classworks as $group)
            <div class="card p-4 mb-4">
                <h3>{{$group->first()->topic->name}}</h3>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach($group as $classwork)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$classwork->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                {{$classwork->title}}
                            </button>
                        </h2>
                        <div id="flush-collapse{{$classwork->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">{{$classwork->description}}</div>
                            <div class="actions d-flex justify-content-end mb-4 me-3">
                                <a href="{{route('classrooms.classworks.edit' , [$classroom->id , $classwork->id ])}}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form action="{{route('classrooms.classworks.destroy',  [$classroom->id , $classwork->id])}}" method="post" class="ms-3">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
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
</x-main-layout>