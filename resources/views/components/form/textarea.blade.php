@props([
'name' ,
'value' => '' ,

])

<textarea style="height: 100px" name="{{$name}}" 
id="{{$id ?? $name}}"
 {{ $attributes->class(['form-control' , 'is-invalid'=> $errors->has($name)])}}>{{old($name , $value)}}</textarea>
