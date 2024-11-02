<?php
namespace App\Models\NotificationConfig;

use App\Models\NotificationConfig;
use Illuminate\Support\Facades\DB;

class Email
{
    const FIELD_SENDER_EMAIL = 'senderEmail';
    const FIELD_SENDER_NAME = 'senderName';

    public function __construct(protected NotificationConfig $_config)
    {}

    public function loadConfig()
    {
        $config = (array) $this->_config?->config;
        if (! empty($config)) {
            return unserialize($config[0]);
        }

        return [self::FIELD_SENDER_EMAIL => '', self::FIELD_SENDER_NAME => ''];
    }
}
