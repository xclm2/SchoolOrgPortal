<?php
namespace App\Notifications;

use App\Mail\EmailVerification;
use App\Models\NotificationConfig;
use App\Sms\Provider\Itexmo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class Notify
{
    public function __construct($object = null)
    {}

    public function sendOtp($code, $email, $phone)
    {
        $notification = new NotificationConfig();
        $config = $notification->getEnabled();

        switch ($config->type) {
            case NotificationConfig::TYPE_ITEXMO:
                $config = new NotificationConfig\Itexmo($config->getItexmoConfig());
                $sms = new Itexmo($config->apiCredentials());
                $sms->send("Your OTP code is: $code", ["0$phone"]);;
                break;
            case NotificationConfig::TYPE_EMAIL:
                Mail::to($email)->send(new EmailVerification($code));
                break;
        }
    }

    public function newEvent(mixed $users, \App\Models\Organization $organization, \App\Models\Organization\Post $post)
    {
        $notification = new NotificationConfig();
        $config = $notification->getEnabled();

        switch ($config->type) {
            case NotificationConfig::TYPE_ITEXMO:
                $postUrl = url('/event/' . $post->id);
                $config = new NotificationConfig\Itexmo($config->getItexmoConfig());
                $phones = [];
                foreach($users->pluck('phone') as $phone) {
                    $phones[] = "0$phone";
                }

                $sms = new Itexmo($config->apiCredentials());
                $sms->send("New Event Alert – Check It Out!
Hi {$organization->name} members!,

Event: {$post->title}

View full details here: $postUrl", $phones);
                break;
            case NotificationConfig::TYPE_EMAIL:
                $config = new NotificationConfig\Email($config->getEmailConfig());
                Notification::send($users->get(), new Post($post, $organization, $config->loadConfig()));
                break;
        }
    }

    public function eventReminder($users, \App\Models\Organization $organization, \App\Models\Organization\Post $post)
    {
        $notification = new NotificationConfig();
        $config = $notification->getEnabled();

        switch ($config->type) {
            case NotificationConfig::TYPE_ITEXMO:
                $postUrl = url('/event/' . $post->id);
                $eventDate = date('M d, Y', strtotime($post->start_date));
                $config = new NotificationConfig\Itexmo($config->getItexmoConfig());
                $phones = [];
                foreach($users->pluck('phone') as $phone) {
                    $phones[] = "0$phone";
                }

                $sms = new Itexmo($config->apiCredentials());
                $sms->send("Friendly Reminder: Upcoming Event Tomorrow!
Hi {$organization->name} members!,
Just a quick reminder that our upcoming event, $post->title, is happening tomorrow, $eventDate. We’re looking forward to having you join us for this exciting event!

View full details here: $postUrl", $phones);
                break;
            case NotificationConfig::TYPE_EMAIL:
                $config = new NotificationConfig\Email($config->getEmailConfig());
                Notification::send($users->get(), new EventReminder($post, $organization, $config->loadConfig()));
                break;
        }
    }
}
