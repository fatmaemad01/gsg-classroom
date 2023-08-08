<x-main-layout title="Topic">
    <x-nav />
    <div class="container m-5">
        <div class="row">
            <div class="col-lg-1">
                <a href="" class="text-success fw-bold" style="font-size: 15px;">
                    All Topics
                </a>
                <ul class="nav">
                    @foreach($classroom->topics as $topic)
                    <li class="nav-item mt-4">
                        <a href="{{route('topics.index' , $topic->id)}}" class="text-secondary pt-4 ">{{$topic->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-10">
                @foreach($classworks as $classwork)
                <div class="card p-5 m-5">
                    <h2>{{$classwork->title}}</h2>
                </div>
                @endforeach
            </div>
        </div>


    </div>

</x-main-layout>