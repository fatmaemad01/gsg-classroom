<x-main-layout title="Trashed Classrooms">
<x-nav />

    <x-alert name="success" id="success" class="alert-success" />

    <div class="container mt-4 ">
        <div class="header d-flex justify-content-between">
            <div class="services mb-3">
                <i class="fa-solid fa-list-check " style="color: #4285f4"></i>
                <a href="#" class="ps-1">To do</a>

                <i class="fa-regular fa-rectangle-list ms-3" style="color: #4285f4"></i>
                <a href="#" class="ps-1">To review</a>

                <i class="fa-regular fa-calendar ms-3" style="color: #4285f4"></i>
                <a href="#" class="ps-1">Calender</a>
            </div>
        </div>
        <div class="container">
            <div class="classrooms m-3">
                <div class="row ms-3">
                    @foreach($classrooms as $classroom)
                    <div class="col-md-3 me-4 mt-3 p-0 card" style="width: 23rem">
                        @if($classroom->cover_image_path)
                        <img src="{{asset('storage/' . $classroom->cover_image_path)}}" class="card-img-top m-0" alt="..." height="160" width="21rem" />
                        @else
                        <img src="{{asset('./img/1.jpg')}}" class="card-img-top" alt="..." height="160" width="21rem" />
                        @endif
                        <div class="card-body ">
                            <h5 class="card-title ps-1">{{$classroom->name}}</h5>
                            <p class="card-text ps-1">{{ $classroom->section}}, {{ $classroom->subject}}</p>
                            <div class="actions d-flex justify-content-end">
                                <form action="{{route('classroom.restore' , $classroom->id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                                </form>
                                <form action="{{route('classroom.forceDelete' , $classroom->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn"><i class="fa-solid fa-trash pe-2" style="color:tomato"></i></button>
                                </form>
                               
                            </div>
                        </div>
                    </div> @endforeach
                </div>
            </div>
        </div>


</x-main-layout>