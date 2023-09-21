@csrf
<x-form.form-floating name="name" placeholder="Name">
    <x-form.input name="name" :value="$topic->name" placeholder="Name" />
</x-form.form-floating>
<div class="form-floating mb-3">
    <button type="submit" class="btn btn-success">{{__($button)}}</button>
</div>
