<div class="form-floating mb-3">
    {{ $slot}}
    <label for="{{$name}}">{{__($placeholder)}}</label>
    <x-error-message name="{{$name}}" />
</div>