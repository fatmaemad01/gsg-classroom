<?php

namespace App\Listeners;

use App\Models\Stream;
use Illuminate\Support\Str;
use App\Events\ClassworkUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatedStream
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
    public function handle(ClassworkUpdated $event): void
    {
        $classwork = $event->classwork;

        $content =  __(':name posted a new :type: :title', [
            'name'  => $classwork->user->name,
            'type' => __($classwork->type->value),
            'title' => $classwork->title,
        ]);

        $stream = Stream::where([
            'classroom_id' => $classwork->classroom_id,
            'user_id' => $classwork->user_id,
            'classwork_id' => $classwork->id
        ])->first();

        $stream->update([
            'content' => $content,
        ]);
        // dd($stream);

    }
}
