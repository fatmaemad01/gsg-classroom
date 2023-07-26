<x-main-layout title="Show Classroom">

    <div class="container  mt-4">
        <div class="content m-5">
            <div class="image position-relative">
                @if($classroom->cover_image_path)
                <img src="{{ asset('storage/'.$classroom->cover_image_path)}}" class="img-fluid rounded" alt="x..." height="210" width="100%" />
                @else
                <img src="{{asset('./img/1.jpg')}}" class="" alt="..." height="210" width="21rem" />
                @endif
            </div>
            <div class="head d-flex justify-content-between ">
                <h2 class="mb-3  position-absolute text-white" style="top: 319px; left: 197px;">{{$classroom -> name}} (#{{$classroom->id}}) </h2>
            </div>
            
            <div class="row">
                <div class="col-md-2">
                    <div class="new mt-3 ">
                        <a href="{{route('topics.create' , $classroom->id )}}" class="btn btn-primary ">Add Topics</a>
                    </div>
                    <div class="card mt-3 p-3">
                        <h6 class="fw-light">Class code</h6>
                        <h5>{{$classroom->code}}</h5>
                    </div>
                    <div class="card mt-3 p-3">
                        <h6>Upcoming</h6>
                        <p class="fw-light">no work due in soon</p>
                        <a href="#" class="fw-light">View All</a>
                    </div>

                </div>
                <div class="col">
                    <div class="row-md-3">
                        <h4>invitation link: </h4>
                        <a href="{{$classroom->invitation_link}}">{{$invitation_link}}</a>
                        @foreach($topics as $topic)
                        <div class="card mt-3 p-3">
                            <h5 class="text-capitalize">{{$topic->name}}</h5>
                            <div class="actions d-flex justify-content-end">
                                <a href="{{route('topics.edit' , $topic->id)}}" class=" btn "><i class="fa-regular fa-pen-to-square pe-2"></i></a>
                                <x-delete name="topics.destroy" :id="$topic->id" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-main-layout>