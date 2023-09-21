<div class=" dropdown ">
    <a class="  dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Language
    </a>
    <ul class="dropdown-menu">

        <li>
            <a class="dropdown-item text-dark" href="{{$notification->data['link']}} ?nid={{$notification->id}}">
                Arabic
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item text-dark" href="{{$notification->data['link']}} ?nid={{$notification->id}}">
                English
            </a>
        </li>
    </ul>
</div>