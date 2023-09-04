<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\Stream;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostInStream
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
    public function handle(PostCreated $event): void
    {
        $post = $event->post;

        $content = __(':name posted new post: :content' ,[
            'name' => $post->user->name,
            'content' => $post->content
        ]);

        Stream::create([
            'classroom_id' => $post->classroom_id,
            'user_id' => $post->user_id,
            'post_id' => $post->id,
            'content' => $content,
            'link' => route('posts.show' , $post->id),
        ]);
    }
}
