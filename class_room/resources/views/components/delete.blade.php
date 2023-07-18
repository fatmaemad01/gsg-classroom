@props([
'name' , 'id'
])
<form action="{{route($name , $id)}}" method="post">
    @method('delete')
    @csrf
    <button type="submit" class="btn"><i class="fa-solid fa-trash " style="color:tomato"></i></button>
</form>