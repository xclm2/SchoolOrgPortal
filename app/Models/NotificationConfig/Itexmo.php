<?php
namespace App\Models\NotificationConfig;

use App\Models\NotificationConfig;
use Illuminate\Support\Facades\DB;

class Itexmo
{
    const FIELD_APICODE = 'itexmoApiCode';
    const FIELD_EMAIL = 'itexmoEmail';
    const FIELD_PASSWORD = 'itexmoPassword';

    const FIELD_MAP = [
        self::FIELD_APICODE => 'ApiCode',
        self::FIELD_EMAIL => 'Email',
        self::FIELD_PASSWORD => 'Password',
    ];

    public function __construct(protected NotificationConfig $_config)
    {}

    public function loadConfig()
    {
        $config = (array) $this->_config?->config;
        if (! empty($config)) {
            return unserialize($config[0]);
        }

        return [self::FIELD_EMAIL => '', self::FIELD_APICODE => '', self::FIELD_PASSWORD => ''];
    }

    public function apiCredentials(): bool|array
    {
        $config = $this->loadConfig();
        if (empty($config)) {
            return false;
        }

        $credentials = [];
        foreach ($config as $key => $value) {
            $credentials[self::FIELD_MAP[$key]] = $value;
        }

        return $credentials;
    }
}
