<?php

namespace App\Listeners;

use App\Events\ClassworkCreated;
use App\Models\Stream;
use Illuminate\Support\Str;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostClassworkInStream
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
        // dd($event);


        $classwork = $event->classwork;

        $content =  __(':name posted a new :type: :title', [
            'name'  => $classwork->user->name ,
            'type' => __($classwork->type->value),
            'title' => $classwork->title,
        ]);

        Stream::create([
            'classroom_id' => $classwork->classroom_id ,
            'user_id' => $classwork->user_id,
            'classwork_id' => $classwork->id,
            'content' => $content,
            'link' => route('classrooms.classworks.show' , [
                $classwork->classroom_id,
                $classwork->id,
            ])
        ]);
    }
}
