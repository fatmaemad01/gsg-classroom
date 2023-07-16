@csrf
<div class="form-floating mb-3">
    <input type="text" value="{{old('name' , $classroom->name)}}" @class(['form-control' , 'is-invalid'=> $errors->has('name')]) name="name" id="name" placeholder="Class Name">
    <label for="name">Class Name</label>
    @error('name')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    <input type="text" value="{{old('section' , $classroom->section)}}" @class(['form-control' , 'is-invalid'=> $errors->has('section')]) name="section" id="section" placeholder="Section">
    <label for="section">Section</label>
    @error('section')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    <input type="text" value="{{old('subject' , $classroom->subject)}}" @class(['form-control' , 'is-invalid'=> $errors->has('subject')]) name="subject" id="subject" placeholder="Subject">
    <label for="subject">Subject</label>
    @error('subject')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    <input type="text" value="{{old('room' , $classroom->room)}}" name="room" id="room" placeholder="Class room" @class(['form-control' , 'is-invalid'=> $errors->has('room')])>
    <label for="room">Room</label>
    @error('room')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>

<div class="form-floating mb-3">
    @if($classroom->cover_image_path)
    <img src="{{ asset('storage/' . $classroom->cover_image_path) }}" class="card-img-top" alt="...">
    @endif
    <input type="file" value="{{old('cover_img' , $classroom->cover_img)}}" name="cover_img" id="cover_img" @class(['form-control' , 'is-invalid'=> $errors->has('cover_img')])>
    <label for="cover_img">Cover Image</label>
    @error('cover_img')
    <div class="invalid-feedback">{{$message}}</div>
    @endError
</div>
<div class="form-floating mb-3">
    <button class="btn btn-primary" type="submit">{{$button}}</button>
</div>