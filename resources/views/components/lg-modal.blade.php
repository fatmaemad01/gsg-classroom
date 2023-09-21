@props(['updateRoute'=>'' , 'id'])

<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog row modal-xl modal-dialog-centered">
        <div class="modal-content ">
            <h3>Content</h3>
            <form action="{{ $updateRoute }}" method="post" class="hidden-form d-flex justify-content-start">
                @csrf
                @method('put')
                <div class="modal-body row">

                    @include('classworks._form', [
                        'type' => $classwork->type->value,
                        'button' => 'Edit',])
                </div>
            </form>
        </div>
    </div>
</div>
