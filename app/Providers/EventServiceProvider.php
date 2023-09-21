<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Events\PostCreated;
use App\Events\UserCreated;
use App\Listeners\UserProfile;
use App\Listeners\PostInStream;
use App\Events\ClassworkCreated;
use App\Events\ClassworkSubmitted;
use App\Events\ClassworkUpdated;
use App\Events\PostUpdated;
use App\Listeners\NotifyTeacher;
use App\Listeners\UpdatedStream;
use App\Observers\ClassroomObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\PostClassworkInStream;
use App\Listeners\PostStreamUpdated;
use App\Listeners\SendNotificationToAssignedStudent;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // here we can define more than one listener of one event
        ClassworkCreated::class => [
            PostClassworkInStream::class,
            SendNotificationToAssignedStudent::class
        ],
        PostCreated::class => [
            PostInStream::class
        ],
        UserCreated::class => [
            UserProfile::class
        ],
        ClassworkUpdated::class => [
            UpdatedStream::class
        ],
        PostUpdated::class => [
            PostStreamUpdated::class
        ],
        ClassworkSubmitted::class => [
            NotifyTeacher::class
        ],
    ];

    // protected $observers = [
    //     Classroom::class => [ClassroomObserver::class]
    // ];
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
        // Classroom::observe(ClassroomObserver::class);

        // Event::listen('classwork.created' , PostInClassroomStream::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
