@props([
'name' , 'section', 'subject' ,'room', 'id' ,'cover_image_path'
])
<div class="col-md-3 me-4 mt-3 p-0 card" style="width: 23rem">
    @if($cover_image_path)
    <img src="storage/{{$cover_image_path}}" class="card-img-top m-0" alt="..." height="160" width="21rem" />
    @else
    <img src="{{asset('./img/1.jpg')}}" class="card-img-top" alt="..." height="160" width="21rem" />
    @endif
    <div class="card-body ">
        <h5 class="card-title ps-1">{{$name}}</h5>
        <p class="card-text ps-1">{{ $section}}, {{ $subject}}</p>
        <div class="actions d-flex justify-content-end">
            <a href="{{route('classroom.show' , $id)}}" class="btn"><i class="fa-solid fa-eye pe-2"></i></a>
            <a href="{{route('classroom.edit' , $id)}}" class="btn"><i class="fa-regular fa-pen-to-square pe-2"></i></a>
            <x-delete name="classroom.destroy" :id="$id" />
        </div>
    </div>
</div>