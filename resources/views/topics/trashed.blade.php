<x-main-layout title="Trashed Topic">
    <div class="container  mt-4">
        <div class="content m-5">
            <div class="row">
                <div class="col">
                    <div class="row-md-3">
                        @foreach($topics as $topic)
                        <div class="card mt-3 p-3">
                            <h5 class="text-capitalize">{{$topic->name}}</h5>
                            <div class="actions d-flex justify-content-end">
                                <form action="{{route('topics.restore' , $topic->id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                                </form>
                                <form action="{{route('topics.forceDelete' , $topic->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn"><i class="fa-solid fa-trash pe-2" style="color:tomato"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>