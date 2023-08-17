<x-main-layout title="Show">
    <x-secondary-nav id="$classwork->id" />
    <div class="container p-5">
        <x-alert name="success" class="alert-success" />
        <x-alert name="error" class="alert-danger" />
        <x-errors />
        <div class="row">
            <div class="col-lg-8">
                <div class="py-4">
                    <h2 class="text-success fw-bold"> <i class="fas fa-file-lines me-3"></i> {{$classwork->title}}</h2>
                    <p class="text-secondary ">By. {{$classroom->teachers->first()->name}} . {{$classwork->created_at->diffForHumans(null , true)}}</p>
                    <p class="fw-normal">{{$classwork->description}}</p>
                </div>
                <h6 class=" mt-5 mb-3 text-secondary" style="font-size: 17px;"><i class="fas fa-user-group me-2"></i> Class comments</h6>
                <div class="mt-3">
                    @foreach ($classwork->comments as $comment)
                    <div class="row">
                        <div class="col-lg-1">
                            <img src="https://ui-avatars.com/api/?name={{$comment->user->name}}" class="mt-2" alt="" height="35px" width="35px" style="border-radius: 50%" />
                        </div>
                        <div class="col-lg-8">
                            <!-- Carbon Package to date formats  -->
                            <p style="margin-bottom: 5px;"><span class="text-secondary fw-bold me-3"> {{ $comment->user->name }}</span> <span class="fw-light" style="font-size: 14px;"> {{$comment->created_at->format('H:i')}}</span></p>
                            <p class="fw-normal" style="font-size: 15px;">{{ $comment->content }}</p>
                        </div>
                        <div class=" col-lg-2 ">
                            <div class="comment-container d-flex justify-content-between">
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
                        <form class="edit-form" action="{{route('comments.update', $comment->id)}}" method="post" style="display: none;">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{$classwork->id}}">
                            <input type="hidden" name="type" value="classwork">
                            <x-form.form-floating name="content" placeholder="Add a class comment">
                                <x-form.textarea name="content" placeholder="Add a class comment" :value="$comment->content">
                                </x-form.textarea>
                            </x-form.form-floating>
                            <button type="submit" class="btn btn-success">Edit</button>
                            <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                        </form>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <form action="{{route('comments.store')}}" method="post" class="d-flex justify-content-start">
                        <div class="col-lg-10">
                            @csrf
                            <input type="hidden" name="id" value="{{$classwork->id}}">
                            <input type="hidden" name="type" value="classwork">
                            <x-form.form-floating name="content" placeholder="Add a class comment">
                                <x-form.textarea name="content" placeholder="Add a class comment">
                                </x-form.textarea>
                            </x-form.form-floating>
                        </div>
                        <div class="col-lg-2 m-4">
                            <button type="submit" class="btn btn-success" style="position: relative; top: 37px;"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>



            </div>
            <div class="col-lg-4 ">
                <div class="card mb-5 p-5 shadow-lg p-3 mb-5 bg-body rounded" style="border: none;">
                    <div class="head d-flex justify-content-between">
                        <h5 class="text-secondary">Your Work</h5>
                        <p class="text-secondary" style="font-size: 14px;">Handed in</p>
                    </div>

                    <form action="{{route('submissions.store' , $classwork->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-form.form-floating name="files.0" placeholder="submit your work">
                            <x-form.input name="files[]" type="file" multiple accept="image/* , application/pdf" placeholder="submit your work" />
                        </x-form.form-floating>
                        <button class="btn btn-success" style="width: 100%;">Submit</button>
                    </form>
                </div>
                <div class="card p-5 shadow-lg p-3 mb-5 bg-body rounded" style="border: none;">
                    <h6 class="text-secondary"> <i class="fas fa-user me-2"></i> Private Comments </h6>
                    <a href="" class="text-success fw-bold mt-2" style="font-size: 15px;">Add Private comment to {{$classroom->teachers->first()->name}}</a>
                </div>
                @if($submissions->count())
                <div class=" mb-5 p-5 shadow-lg p-3 mb-5 bg-body rounded">
                    <h5 class="text-secondary">Your Submissions</h5>
                    <ul>
                        @foreach ($submissions as $submission)
                        <li><a href="{{route('submission.file' , $submission->id)}}">File: {{$loop->iteration}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
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
    @endPush
</x-main-layout>