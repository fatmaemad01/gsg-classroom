<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ClassworkCreated;
use App\Jobs\SendClassroomNotification;
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
        // Notification::send($event->classwork->users, new NewClassworkNotification($event->classwork));
        $classwork = $event->classwork;

        $job =
            new SendClassroomNotification(
                $classwork->users,
                new NewClassworkNotification($event->classwork)
            );
        $job->onQueue('notifications');
        $job->dispatch()->onQueue('notifications');
        // SendClassroomNotification::dispatch();
    }
}
