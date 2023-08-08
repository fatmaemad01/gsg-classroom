@props (['id'])
<x-nav>
    <div class="text-center" style="margin: 0; position: relative; top: 6px; right: 71px;">
        <a href="{{route('classroom.show' , $id)}}" class="btn nav-item">Stream</a>
        <a href="{{route('classrooms.classworks.index' , $id)}}" class="btn nav-item">Classworks</a>
        <a href="{{route('classroom.people' , $id)}}" class="btn nav-item">People</a>
        <a href="" class="btn nav-item">Mark</a>
    </div>
</x-nav>

<div class="container">
{{$slot}}
</div>
