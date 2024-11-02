<?php

namespace App\Notifications;

use App\Models\NotificationConfig\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminder extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public \App\Models\Organization\Post $post,
        public \App\Models\Organization $organization,
        public array $sender
    )
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $eventDate = date('M d, Y', strtotime($this->post->start_date));

        return (new MailMessage)
            ->from($this->sender[Email::FIELD_SENDER_EMAIL], $this->sender[Email::FIELD_SENDER_NAME])
            ->greeting("Hey {$this->organization->name} Members!")
            ->subject('Upcoming Event Tomorrow!')
            ->line("Just a quick reminder that our upcoming event, {$this->post->title}, is happening tomorrow, $eventDate. We’re looking forward to having you join us for this exciting event!")
            ->line('Click the link/button below to see more details.')
            ->action('View Event', url('/event/' . $this->post->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
