<?php

namespace App\Notifications;

use App\Models\Classwork;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Support\Facades\Auth;

class NewClassworkSubmission extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Classwork $classwork)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $classwork = $this->classwork;
        $content =  __(':name handed in the :title assignment', [
            'name'  => Auth::user()->name,
            'title' => $classwork->title,
        ]);

        return (new MailMessage)
            ->subject(__('New submission for :title', ['title' => $classwork->title]))
            ->greeting(__('Hi :name', ['name' => $notifiable->name]))
            ->line($content)
            ->action('Show Classwork',  route('classrooms.classworks.show', [$classwork->classroom_id, $classwork->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): DatabaseMessage
    {
        return new DatabaseMessage($this->createMessage());
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->createMessage());
    }

    public function createMessage(): array
    {
        $classwork = $this->classwork;
        $content =  __(':name handed in the :title assignment', [
            'name'  =>Auth::user()->name,
            'title' => $classwork->title,
        ]);

        return [
            'title' => (__('New submission for :title', ['title' => $classwork->title])),
            'body' => $content,
            'image' => '',
            'link' =>  route('classrooms.classworks.show', [$classwork->classroom_id, $classwork->id])
        ];
    }
}
