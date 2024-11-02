<?php

namespace App\Notifications;

use App\Models\NotificationConfig\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class Post extends Notification implements ShouldQueue
{
    use Queueable, Notifiable;

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
        return ['mail', 'database'];
    }

    /**
     * Determine the notification's delivery delay.
     *
     * @return array<string, \Illuminate\Support\Carbon>
     */
//    public function withDelay(object $notifiable): array
//    {
//        return [
//            'mail' => now()->addMinutes(1),
//            'sms' => now()->addMinutes(10),
//        ];
//    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $eventDate = date('M d, Y', strtotime($this->post->start_date));
        if ($this->post->end_date != null) {
            $eventDate .= " - " . date('M d, Y', strtotime($this->post->end_date));
        }

        return (new MailMessage)
            ->from($this->sender[Email::FIELD_SENDER_EMAIL], $this->sender[Email::FIELD_SENDER_NAME])
            ->greeting("Hey {$this->organization->name} Members!")
            ->subject('New Event Alert – Check It Out!')
            ->line('New event posted!')
            ->line("Event: {$this->post->title}")
            ->line("Event Date: $eventDate")
            ->line('Click the link/button below to see more details and let us know if you’re joining. We hope to see you there!')
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
            'post_id' => $this->post->id,
            'user_id' => $notifiable->user_id,
        ];
    }
}
