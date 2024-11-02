<?php

namespace App\Livewire\Admin\Config;

use App\Livewire\Admin\AbstractComponent;
use App\Models\NotificationConfig;
use App\Models\NotificationConfig\Email as EmailConfig;
use App\Models\NotificationConfig\Itexmo as ItexmoConfig;

class Notification extends AbstractComponent
{
    public string $enabled = '';
    public string $senderName = '';
    public string $senderEmail = '';
    public EmailConfig $emailConfig;

    public string $itexmoApiCode = '';
    public string $itexmoEmail = '';
    public string $itexmoPassword = '';

    public function mount()
    {
        $notificationConfig = new NotificationConfig();
        $this->enabled = $notificationConfig->getEnabled()?->type ?? NotificationConfig::TYPE_EMAIL;

        // Itexmo Config
        $itexmo = new ItexmoConfig($notificationConfig->getItexmoConfig());
        $itexmoConfig = $itexmo->loadConfig();
        $this->itexmoApiCode  = $itexmoConfig[ItexmoConfig::FIELD_APICODE];
        $this->itexmoEmail    = $itexmoConfig[ItexmoConfig::FIELD_EMAIL];
        $this->itexmoPassword = $itexmoConfig[ItexmoConfig::FIELD_PASSWORD];

        // Email Config
        $email = new EmailConfig($notificationConfig->getEmailConfig());
        $emailConfig = $email->loadConfig();
        $this->senderName  = $emailConfig['senderName'];
        $this->senderEmail = $emailConfig['senderEmail'];
    }

    public function render()
    {
        return view('livewire.admin.config.notification');
    }

    public function saveConfig()
    {
        $rule = match ($this->enabled) {
            NotificationConfig::TYPE_ITEXMO => [
                'itexmoApiCode'  => 'required|string',
                'itexmoEmail'    => 'required|string|email',
                'itexmoPassword' => 'required|string',
            ],
            NotificationConfig::TYPE_EMAIL => [
                'senderName' => 'required|string',
                'senderEmail' => 'required|string|email',
            ],
            default => throw new \Exception('Invalid notification enabled'),
        };


        $config = $this->validate($rule);

        $notification = new NotificationConfig();
        $notification->saveConfig($config, $this->enabled);
        $notification->setEnabled($this->enabled);
        $this->dispatch('notification-config-saved');
    }
}
