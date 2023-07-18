@csrf
<x-form.form-floating name="name" placeholder="Name">
    <x-form.input name="name" :value="$topic->name" placeholder="Name" />
</x-form.form-floating>

 {{-- <div class="form-floating mt-3 mb-3">
    <select id="classroom_id" name="classroom_id" @class(['form-control' , 'is-invalid'=> $errors->has('classroom_id')])>
        <option value="">Classroom</option>
        @foreach(\App\Models\Classroom::all() as $classroom)
        <option @class(['form-control' , 'is-invalid'=> $errors->has('classroom_id')]) value="{{$classroom->id}}" @if ($classroom->id == old('classroom_id' , $topic->classroom_id)) selected @endif>{{$classroom->name}}</option>
        @endforeach
    </select>
    <label for="classroom_id" class="label-control">Classroom </label>
    <x-error-message name="classroom_id"/>

</div> --}}

<div class="form-floating mb-3">
    <button type="submit" class="btn btn-primary">{{$button}}</button>
</div>