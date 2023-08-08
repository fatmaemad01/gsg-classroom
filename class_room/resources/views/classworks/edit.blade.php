<x-main-layout title="Create Classwork">
<x-secondary-nav :id="$classroom->id"/>

    <div class="container mt-5">
        <h3>Edit {{$classwork->title}}</h3>
        <hr>
        <form action="{{route('classrooms.classworks.update' , [$classroom->id , $classwork->id ,'type'=>$type])}}" method="post">
            @method('patch')
            @csrf
            <div class="row">
                <hr>
                <div class="col-md-8">
                    <x-form.form-floating name="title" placeholder="Title">
                        <x-form.input name="title" :value="$classwork->title" placeholder="Title" />
                    </x-form.form-floating>
                    <x-form.form-floating name="description" placeholder="Description">
                        <x-form.textarea name="description" placeholder="Description (optional)" :value="$classwork->description"></x-form.textarea>
                    </x-form.form-floating>
                    <x-form.form-floating name="topic_id" placeholder="Topic">
                        <x-slot:labe>
                            <label for="topic_id">Topic (optional)</label>
                        </x-slot:labe>
                        <select class="form-select" name="topic_id" id="topic_id">
                            <option value="">No Topic</option>
                            @foreach($classroom->topics as $topic)
                            <option value="{{$topic->id}}" @if ($topic->id == old('topic_id' , $classwork->topic_id)) selected @endif>{{$topic->name}}</option>
                            @endforeach
                        </select>
                        <x-error-message name="topic_id" />
                    </x-form.form-floating>

                </div>
                <div class="col-md-3 ms-5">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            All Students
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            @foreach($classroom->students as $student)
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <input class="form-check-input" name="students[]" type="checkbox" value="{{$student->id}}" id="std--{{$student->id}}" @checked(in_array($student->id , $assigned))>
                                    <label class="form-check-label" for="std--{{$student->id}}">
                                        {{$student->name}}
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
                <button class="btn btn-success" type="submit">Update </button>
        </form>
    </div>
</x-main-layout>