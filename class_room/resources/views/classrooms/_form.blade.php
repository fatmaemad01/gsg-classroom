@csrf

<x-form.form-floating name="name" placeholder="Name">
    <x-form.input name="name" :value="$classroom->name" placeholder="Name" />
</x-form.form-floating>

<x-form.form-floating name="section" placeholder="Section">
    <x-form.input name="section" :value="$classroom->section" placeholder="Section" />
</x-form.form-floating>

<x-form.form-floating name="subject" placeholder="Subject">
    <x-form.input name="subject" :value="$classroom->subject" placeholder="Subject" />
</x-form.form-floating>

<x-form.form-floating name="room" placeholder="Room">
    <x-form.input name="room" :value="$classroom->room" placeholder="Room" />
</x-form.form-floating>

<x-form.form-floating name="cover_img" placeholder="Cover Image">
    @if($classroom->cover_image_path)
    <img src="{{ asset('storage/' . $classroom->cover_image_path) }}" class="card-img-top" alt="..." height="160px">
    @endif
    <x-form.input type="file" name="cover_img" :value="$classroom->cover_img" placeholder="Cover Image" />
</x-form.form-floating>

<div class="form-floating mb-3">
    <button class="btn btn-success" type="submit">{{$button}}</button>
</div>