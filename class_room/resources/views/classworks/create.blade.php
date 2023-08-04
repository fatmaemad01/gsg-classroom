<x-main-layout title="Create Classwork">
<x-secondary-nav :id="$classroom->id"/>
    <div class="container mt-5">
        <h3>Create {{$type}}</h3>
        <hr>
        <form action="{{route('classrooms.classworks.store' , [$classroom->id , 'type'=>$type])}}" method="post">
            @csrf
            <x-form.form-floating name="title" placeholder="Title">
                <x-form.input name="title" :value="$classwork->name" placeholder="Title" />
            </x-form.form-floating>
            <x-form.form-floating name="description" placeholder="Description">
                <x-form.textarea name="description" placeholder="Description (optional)">{{$classwork->description}}</x-form.textarea>
            </x-form.form-floating>
            <x-form.form-floating name="topic_id" placeholder="Topic">
                <x-slot:labe>
                    <label for="topic_id">Topic (optional)</label>
                </x-slot:labe>
                <select class="form-select" name="topic_id" id="topic_id">
                    <option value="">No Topic</option>
                    @foreach($classroom->topics as $topic)
                    <option value="{{$topic->id}}">{{$topic->name}}</option>
                    @endforeach
                </select>
                <x-error-message name="topic_id" />
            </x-form.form-floating>
            <x-form.form-floating name="description" placeholder="">
                <button class="btn btn-primary" type="submit">Create {{$type}}</button>
            </x-form.form-floating>
        </form>
    </div>
</x-main-layout>