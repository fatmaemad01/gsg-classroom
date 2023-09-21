@props ([
'type' => 'text' ,
'name' ,
'placeholder' ,
'value' => '' ,
])

<div class="form-floating mb-3">
    <input type="{{$type}}"
           value="{{old($name , $value)}}" 
           name="{{$name}}" id="{{$id ?? $name}}" 
           placeholder="{{$placeholder}}" 
           {{ $attributes->class(['form-control' , 'is-invalid'=> $errors->has($name)])}}
           >
    <label for="{{$name}}">{{$placeholder}}</label>
    <x-error-message name="{{$name}}" />

</div>