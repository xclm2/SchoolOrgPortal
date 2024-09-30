<?php

namespace App\Notifications;

use App\Models\Organization as OrganizationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Organization extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public OrganizationModel $organization)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $array = [
            'organization_id' => $this->organization->id,
            'type' => $this->organization->wasRecentlyCreated  ? 'created' : 'updated',
        ];

        if (! $this->organization->wasRecentlyCreated) {
            $array['changes'] = $this->organization->getChanges();
        }

        return $array;
    }

    public static function getMessage(array $data): string
    {
        $message = match($data['type']) {
            'created' => self::createdMessage($data['organization_id']),
            'updated' => self::updatedMessage($data['organization_id'], $data),
            default => ''
        };

        return $message ?? '';
    }

    public static function createdMessage($id): string
    {
        $organization = OrganizationModel::find($id);
        return "New organization <b>$organization->name</b>";
    }

    public static function updatedMessage($id, $data): string
    {
        $organization = OrganizationModel::find($id);
        if (count($data['changes'] ?? []) > 1) {
            return "Organization <b>$organization->name</b> updated their information.";
        }

        return "New organization <b>$organization->name</b>";
    }
}
