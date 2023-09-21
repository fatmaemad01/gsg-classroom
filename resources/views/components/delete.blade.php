@props([
'name' , 'id'
])
<form action="{{route($name , $id)}}" method="post">
    @method('delete')
    @csrf
    <button type="submit" class="btn"><i class="fa fa-trash " style="color:tomato; font-size:20px"></i></button>
</form>
