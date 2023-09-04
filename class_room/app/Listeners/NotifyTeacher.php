<?php

namespace App\Listeners;

use App\Events\ClassworkSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewClassworkSubmission;

class NotifyTeacher
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
    public function handle(ClassworkSubmitted $event): void
    {
        Notification::send($event->classwork->classroom->teachers, new NewClassworkSubmission($event->classwork));
    }
}
