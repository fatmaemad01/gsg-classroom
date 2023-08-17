<div class="col-md-8">
    <x-form.form-floating name="title" placeholder="Title">
        <x-form.input name="title" :value="$classwork->title" placeholder="Title" />
    </x-form.form-floating>
    <x-form.form-floating name="description" placeholder="Description">
        <x-form.textarea name="description" placeholder="Description (optional)" :value="$classwork->description"></x-form.textarea>
    </x-form.form-floating>

    <x-form.form-floating name="description" placeholder="">
        <button class="btn btn-success" type="submit">{{$button}} {{$type}}</button>
    </x-form.form-floating>

</div>
<div class="col-md-3 ms-5">
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
    <x-form.form-floating name="published_at" placeholder="Publish Time">
        <x-form.input name="published_at" placeholder="Publish Time" :value="$classwork->published_date" type="date" />
    </x-form.form-floating>
    @if($type == 'assignment')
    <x-form.form-floating name="options.grade" placeholder="grade">
        <x-form.input name="options[grade]" placeholder="grade" :value="$classwork->options['grade'] ?? '' " type="number" min="0">{{$classwork->grade}}</x-form.input>
    </x-form.form-floating>
   
    <x-form.form-floating name="options.due" placeholder="Due Date">
        <x-form.input name="options[due]" placeholder="due date" :value="$classwork->options['due'] ?? '' " type="date">{{$classwork->due}}</x-form.input>
    </x-form.form-floating>
    @endif
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
            All Students
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            @foreach($classroom->students as $student)
            <li class="dropdown-item">
                <div class="form-check">
                    <input class="form-check-input" name="students[]" type="checkbox" value="{{$student->id}}" id="std-{{$student->id}}" @checked( !isset($assigned) || in_array($student->id , $assigned))>
                    <label class="form-check-label" for="std--{{$student->id}}">
                        {{$student->name}}
                    </label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>