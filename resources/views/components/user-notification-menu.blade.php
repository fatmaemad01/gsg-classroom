<div class=" dropdown ">
    <button type="button" class="btn dropdown-toggle position-relative " role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        Notifications
        @if ($unreadCount)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $unreadCount }}
                <span class="visually-hidden">unread messages</span>
            </span>
        @endif
    </button>

    <ul class="dropdown-menu">
        @foreach ($notifications as $notification)
            <li>
                <a class="dropdown-item text-dark"
                    href="{{ $notification->data['link'] }} ?nid={{ $notification->id }}">
                    @if ($notification->unread())
                        <i class="fas fa-eye text-secondary me-2"></i>
                    @endif
                    {{ $notification->data['body'] }}
                    <br>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
        @endforeach
    </ul>
</div>
