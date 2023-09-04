<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ClassworkCreated;
use App\Notifications\NewClassworkNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAssignedStudent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassworkCreated $event): void
    {
        // user need to receive notification , notification class
        Notification::send($event->classwork->users, new NewClassworkNotification($event->classwork));
    }
}
