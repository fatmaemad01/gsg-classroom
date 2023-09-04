<x-main-layout :title="$post->classroom->name">
    <x-nav />
    <div class="container p-5">
        <div class="card p-4 mt-4">
            <div class=" d-flex justify-content-start">
                <div>
                    <i class="fas fa-file-lines mt-2 me-4 ms-2 text-success" style="font-size: 26px;"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark"> {{ $post->user->name }} posted new post :
                        {{ $post->content }}
                        <p style="font-size: 14px;" class="text-secondary fw-normal mt-2">
                            {{ $post->created_at->format('F j, Y') }}
                        </p>
                    </h6>
                </div>
            </div>
            <form action="{{ route('posts.destroy', [$post->classroom_id, $post->id]) }}" method="post"
                class=" d-flex justify-content-end">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-outline-secondary me-3" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="fas fa-pencil"></i>
                </button>
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-trash   "></i>
                </button>
            </form>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    </div>
                    <form action="{{ route('posts.update', $post->id) }}" method="post"
                        class="hidden-form d-flex justify-content-start">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="">
                                <x-form.form-floating name="content" placeholder="Announce something to your class">
                                    <x-form.textarea name="content" placeholder="Announce something to your class"
                                        :value="$post->content">
                                    </x-form.textarea>
                                </x-form.form-floating>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mt-3"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success mt-3">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <hr class="text-secondary">
        <div class="card p-4 mt-4">
                <h6 class="fw-bold text-dark mb-4">
                    <i class="fas fa-comments mt-2 me-3 ms-2 text-success" style="font-size: 26px;"></i>  Post Comments
                </h6>
                <div class="a">
                    <div class="">
                        @foreach ($post->comments as $comment)
                            <div class="row">
                                <div class="col-lg-1">
                                    <img src="https://ui-avatars.com/api/?name={{ $comment->user->name }}"
                                        class="mt-2 ms-2" alt="" height="35px" width="35px"
                                        style="border-radius: 50%" />
                                </div>
                                <div class="col-lg-9">
                                    <!-- Carbon Package to date formats  -->
                                    <p style="margin-bottom: 5px;"><span class="text-secondary fw-bold me-3">
                                            {{ $comment->user->name }}</span> <span class="fw-light"
                                            style="font-size: 14px;">
                                            {{ $comment->created_at->format('H:i') }}</span>
                                    </p>
                                    <p class="fw-normal" style="font-size: 15px;">
                                        {{ $comment->content }}</p>
                                </div>
                                <div class=" col-lg-2">
                                    <div class="comment-container d-flex justify-content-end">
                                        <h5 class="ms-3 mt-3 btn btn-outline-secondary toggle-form">
                                            <i class="fas fa-pencil"></i>
                                        </h5>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="mt-3 ms-2 btn btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form class="edit-form mb-3" action="{{ route('comments.update', $comment->id) }}"
                                method="post" style="display: none;">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $post->id }}">
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
                            <form action="{{ route('comments.store') }}" method="post"
                                class="d-flex justify-content-start">
                                <div class="col-lg-11">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                    <input type="hidden" name="type" value="post">
                                    <x-form.form-floating name="content" placeholder="Add a class comment">
                                        <x-form.input name="content" placeholder="Add a class comment">
                                        </x-form.input>
                                    </x-form.form-floating>
                                </div>
                                <div class="col-lg-1 m-4">
                                    <button type="submit" style="position: relative; top: -5px"
                                        class="btn btn-success"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
@endpush
</x-main-layout>
