<?php

namespace App\Listeners;

use App\Models\Stream;
use App\Events\PostUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostStreamUpdated
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
    public function handle(PostUpdated $event): void
    {
        $post = $event->post;

        $content =  __(':name posted a new post: :title', [
            'name'  => $post->user->name,
            'title' => $post->content,
        ]);

        $stream = Stream::where([
            'classroom_id' => $post->classroom_id,
            'user_id' => $post->user_id,
            'post_id' => $post->id
        ])->first();

        $stream->update([
            'content' => $content,
        ]);

    }
}
