@props (['id'])
<x-nav>
    <div class="text-center" style="margin: 0; position: relative; top: 6px; right: 71px;">
        <a href="{{route('classroom.show' , $id)}}" class="btn nav-item">{{__('Stream')}}</a>
        <a href="{{route('classrooms.classworks.index' , $id)}}" class="btn nav-item">{{__('Classworks')}}</a>
        <a href="{{route('classroom.people' , $id)}}" class="btn nav-item">{{__('People')}}</a>
        <a href="" class="btn nav-item">{{__('Mark')}}</a>
    </div>
</x-nav>

<div class="container">
{{$slot}}
</div>
