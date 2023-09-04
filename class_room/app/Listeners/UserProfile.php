<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Profile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserProfile
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
    public function handle(UserCreated $event): void
    {
        $user = $event->user;

        Profile::create([
            'user_id'=> $user->id,
            'first_name'=> $user->name ,
        ]);
    }
}
