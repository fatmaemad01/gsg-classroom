<x-main-layout :title="$classroom->name">
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

                    <h3 class="mb-3  position-absolute " style="top: 143px; right: 158px;"><a href="{{route('classroom.edit' , $classroom->id)}} " class="text-white"><i class="fas fa-gear"></i></a></h3>
                </div>

                <div class="row">
                    <div class="col-md-2 mt-3">
                        <div class="new mt-3 ">
                            <a href="{{route('topics.create' , $classroom->id )}}" style="width: 100%;" class="btn btn-success ">Add Topics</a>
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
                            <div class="shadow p-3 mb-5 bg-body rounded mt-5 p-3" id="initialDiv" style="height: 80px;">
                                <div class="actions d-flex justify-content-between">
                                    <div class="d-flex justify-content-start ">
                                        <img src="{{asset('./img/pexels-masha-raymers-2726111.jpg')}}" class="me-4 ms-3" alt="" height="42px" width="42px" style="border-radius: 50%" />
                                        <p class="pt-3" style="font-size: 14px; color:#b1b1b1">Announce something to your class</p>
                                    </div>
                                    <a href="#" class="btn" onclick="toggleForm()">
                                        <i class="fa-solid fa-right-left pt-2"></i>
                                    </a>
                                </div>
                            </div>
                            <div id="commentForm" class="hidden-form shadow p-4 mb-5 bg-body rounded mt-5 p-3 d-none justify-content-start">
                                <div class="row-12">
                                    <form action="{{route('posts.store' , $classroom->id)}}" method="post" class="hidden-form d-flex justify-content-start">
                                        @csrf
                                        <div class="col-9">
                                            <x-form.form-floating name="content" placeholder="Announce something to your class">
                                                <x-form.textarea name="content" placeholder="Announce something to your class">
                                                </x-form.textarea>
                                            </x-form.form-floating>
                                        </div>
                                        <div class="col-3 ms-3">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    All Students
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    @foreach($classroom->students as $student)
                                                    <li class="dropdown-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="students[]" type="checkbox" value="{{$student->id}}" id="std--{{$student->id}}" checked>
                                                            <label class="form-check-label" for="std--{{$student->id}}">
                                                                {{$student->name}}
                                                            </label>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <button type="submit" class="btn btn-success mt-3">Post</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            @forelse($posts as $post)
                            <div class="card p-4 mt-4">
                                <div class=" d-flex justify-content-start">
                                    <div>
                                        <i class="fas fa-file-lines mt-2 me-4 ms-2 text-success" style="font-size: 26px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark"> {{$post->user->name}} posted new post : {{$post->content}}
                                            <p style="font-size: 14px;" class="text-secondary fw-normal mt-2">{{$post->created_at->format('F j, Y')}}
                                            </p>
                                        </h6>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                            </div>
                                            <form action="{{route('posts.update' , $post->id)}}" method="post" class="hidden-form d-flex justify-content-start">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="">
                                                        <x-form.form-floating name="content" placeholder="Announce something to your class">
                                                            <x-form.textarea name="content" placeholder="Announce something to your class" :value="$post->content">
                                                            </x-form.textarea>
                                                        </x-form.form-floating>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success mt-3">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('posts.destroy' , [ $classroom->id , $post->id])}}" method="post" class=" d-flex justify-content-end">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-outline-secondary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash   "></i>
                                    </button>
                                </form>


                                <hr class="text-secondary">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$post->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Post Comments
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{$post->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                @foreach ($post->comments as $comment)
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <img src="https://ui-avatars.com/api/?name={{$comment->user->name}}" class="mt-2" alt="" height="35px" width="35px" style="border-radius: 50%" />
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <!-- Carbon Package to date formats  -->
                                                        <p style="margin-bottom: 5px;"><span class="text-secondary fw-bold me-3"> {{ $comment->user->name }}</span> <span class="fw-light" style="font-size: 14px;"> {{$comment->created_at->format('H:i')}}</span></p>
                                                        <p class="fw-normal" style="font-size: 15px;">{{ $comment->content }}</p>
                                                    </div>
                                                    <div class=" col-lg-2">
                                                        <div class="comment-container d-flex justify-content-end">
                                                            <h5 class="ms-3 mt-3 btn btn-outline-secondary toggle-form">
                                                                <i class="fas fa-pencil"></i>
                                                            </h5>
                                                            <form action="{{route('comments.destroy' , $comment->id)}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="mt-3 ms-2 btn btn-outline-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form class="edit-form mb-3" action="{{route('comments.update', $comment->id)}}" method="post" style="display: none;">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="id" value="{{$post->id}}">
                                                    <input type="hidden" name="type" value="post">
                                                    <x-form.form-floating name="content" placeholder="Add a class comment">
                                                        <x-form.textarea name="content" placeholder="Add a class comment" :value="$comment->content">
                                                        </x-form.textarea>
                                                    </x-form.form-floating>
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                    <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                                                </form>

                                                @endforeach
                                                <div class="comments">
                                                    <form action="{{route('comments.store' )}}" method="post" class="d-flex justify-content-start">
                                                        <div class="col-lg-11">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{$post->id}}">
                                                            <input type="hidden" name="type" value="post">
                                                            <x-form.form-floating name="content" placeholder="Add a class comment">
                                                                <x-form.input name="content" placeholder="Add a class comment">
                                                                </x-form.input>
                                                            </x-form.form-floating>
                                                        </div>
                                                        <div class="col-lg-1 m-4">
                                                            <button type="submit" style="position: relative; top: -5px" class="btn btn-success"><i class="fas fa-paper-plane"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <!-- <p class="text-secondary fw-bold">There is no posts yet.</p> -->
                            @endforelse
                        </div>
                        @foreach($classworks as $classwork)
                        <a href="{{route('classrooms.classworks.show' , [$classroom->id , $classwork->id ])}}">
                            <div class="card p-4 mt-4">
                                <div class="d-flex justify-content-start">
                                    <div>
                                        <i class="fas fa-file-lines mt-2 me-4 ms-2 text-success" style="font-size: 26px;"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark"> {{$classroom->teachers->first()->name}} posted new {{$classwork->type}}: {{$classwork->title}}
                                            <p style="font-size: 14px;" class="text-secondary fw-normal mt-2">{{$classwork->created_at->format('F j, Y')}}
                                                @if($classwork->updated_at)
                                                (Edited {{$classwork->updated_at->format('F j')}} )
                                                @endif
                                            </p>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                        </a>
                        @endforeach
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

            function toggleForm() {
                var form = document.getElementById('commentForm');
                form.classList.toggle('d-none'); // Toggle the 'd-none' class

                var initialDiv = document.getElementById('initialDiv');
                initialDiv.classList.toggle('d-none');
            }

            document.addEventListener("DOMContentLoaded", function() {
                const toggleFormBtn = document.querySelector(".toggle-form");
                const editForm = document.querySelector(".edit-form");
                const cancelBtn = document.querySelector(".cancel-btn");

                toggleFormBtn.addEventListener("click", function() {
                    editForm.style.display = editForm.style.display === "none" ? "block" : "none";
                });

                cancelBtn.addEventListener("click", function() {
                    editForm.style.display = "none";
                });
            });
        </script>
        @endpush
    </x-secondary-nav>
</x-main-layout>