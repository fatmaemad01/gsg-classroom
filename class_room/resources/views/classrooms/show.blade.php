<x-main-layout title="Show">

    <x-secondary-nav :id="$classroom->id">

        <div class="container  m-4">
            <div class="content m-5">
                <div class="image position-relative">
                    @if($classroom->cover_image_path)
                    <img src="{{ asset('storage/'.$classroom->cover_image_path)}}" class="img-fluid rounded" alt="x..." height="210" width="100%" />
                    @else
                    <img src="{{asset('./img/1.jpg')}}" class="" alt="..." height="210" width="21rem" />
                    @endif
                </div>
                <div class="head d-flex justify-content-between ">
                    <h1 class="mb-3  position-absolute text-white" style="top: 300px; left: 230px;">{{$classroom ->name}} </h1>
                </div>

                <div class="row">
                    <div class="col-md-2 mt-3">
                        <div class="new mt-3 ">
                            <a href="{{route('topics.create' , $classroom->id )}}" style="width: 100%;" class="btn btn-primary ">Add Topics</a>
                        </div>

                        <div class="card mt-3 p-3 ">
                            <div class="d-flex justify-content-between">
                                <h6 class="mt-2"><b>Join Link</b> </h6>
                                <span id="textToCopy" style="display: none;">{{$invitation_link}}</span>
                                <button onclick="copyText()" class="btn btn-secondary"><i class="fas fa-copy"></i></button>

                            </div>
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
                            <div class="shadow p-3 mb-5 bg-body rounded mt-5 p-3" style="height: 80px;">
                                <div class="actions d-flex justify-content-between">
                                    <div class="d-flex justify-content-start ">
                                        <img src="{{asset('./img/pexels-masha-raymers-2726111.jpg')}}" class="me-4 ms-3" alt="" height="42px" width="42px" style="border-radius: 50%" />
                                        <p class="pt-3" style="font-size: 14px; color:#b1b1b1">Announce something to your class</p>
                                    </div>

                                    <a href="" class=" btn "><i class="fa-solid fa-right-left pt-2"></i></i></a>
                                </div>
                            </div>
                            @foreach($topics as $topic)
                            <div class="shadow  p-3 mb-5 bg-body rounded mt-5 p-3 ">
                                <div class="title p-3">
                                    <h5 class="text-capitalize">{{$topic->name}}
                                        <a href="{{route('topics.edit' , $topic->id)}}" class=" btn d-flex justify-content-end ">
                                            <i class="fa-regular fa-pen-to-square pb-2"></i>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @push('scripts')
        <script>
            function copyText() {
                const text = document.getElementById('textToCopy').innerText;

                const tempInput = document.createElement('input');
                tempInput.type = 'text';
                tempInput.value = text;

                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);

            }
        </script>
        @endpush
    </x-secondary-nav>
</x-main-layout>