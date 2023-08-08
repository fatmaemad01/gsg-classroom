<x-main-layout title="Show">
    <x-secondary-nav id="$classwork->id" />
    <x-alert name="success" />
    <x-errors />
    <div class="container p-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card p-4">
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
                        <div class="col-lg-10">
                            <!-- Carbon Package to date formats  -->
                            <p style="margin-bottom: 5px;"><span class="text-secondary fw-bold me-3"> {{ $comment->user->name }}</span> <span class="fw-light" style="font-size: 14px;"> {{$comment->created_at->format('H:i')}}</span></p>
                            <p class="fw-normal" style="font-size: 15px;">{{ $comment->content }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <form action="{{route('comments.store' )}}" method="post" class="d-flex justify-content-start">
                        <div class="col-lg-11">
                            @csrf
                            <input type="hidden" name="id" value="{{$classwork->id}}">
                            <input type="hidden" name="type" value="classwork">
                            <x-form.form-floating name="content" placeholder="Add a class comment">
                                <x-form.textarea name="content" placeholder="Add a class comment">
                                </x-form.textarea>
                            </x-form.form-floating>
                        </div>
                        <div class="col-lg-1 m-4">
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
                    <form action="">
                        <x-form.form-floating name="submit" placeholder="submit your work">
                            <x-form.input name="submit" placeholder="submit your work" />
                        </x-form.form-floating>
                        <button class="btn btn-success" style="width: 100%;">Submit</button>
                    </form>
                </div>
                <div class="card p-5 shadow-lg p-3 mb-5 bg-body rounded" style="border: none;">
                    <h6 class="text-secondary"> <i class="fas fa-user me-2"></i> Private Comments </h6>
                    <a href="" class="text-success fw-bold mt-2" style="font-size: 15px;">Add Private comment to {{$classroom->teachers->first()->name}}</a>
                </div>
            </div>
        </div>
    </div>



</x-main-layout>