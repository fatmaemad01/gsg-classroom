@csrf
<div class="form-floating mt-3 mb-3 ">
    <input type="text" name="name" id="name" @class(['form-control' , 'is-invalid'=> $errors->has('name')]) value="{{old('name' , $topic->name)}}">
    <label for="name" class="label-control">Topic Name:</label>
    @error('name')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>
 {{-- <div class="form-floating mt-3 mb-3">
    <select id="classroom_id" name="classroom_id" @class(['form-control' , 'is-invalid'=> $errors->has('classroom_id')])>
        <option value="">Classroom</option>
        @foreach(\App\Models\Classroom::all() as $classroom)
        <option @class(['form-control' , 'is-invalid'=> $errors->has('classroom_id')]) value="{{$classroom->id}}" @if ($classroom->id == old('classroom_id' , $topic->classroom_id)) selected @endif>{{$classroom->name}}</option>
        @endforeach
    </select>
    <label for="classroom_id" class="label-control">Classroom </label>
    @error('classroom_id')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div> --}}
<div class="form-floating mb-3">
    <button type="submit" class="btn btn-primary">{{$button}}</button>
</div>