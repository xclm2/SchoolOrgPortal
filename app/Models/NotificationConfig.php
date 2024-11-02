<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationConfig extends Model
{
    const TYPE_EMAIL = 'email';
    const TYPE_ITEXMO = 'itexmo';

    const TYPES = [self::TYPE_EMAIL => "Email", self::TYPE_ITEXMO => 'ITEXMO (SMS)'];

    protected $table = 'notification_config';
    protected $fillable = ['type', 'config'];

    public function setEnabled($type)
    {
        $this->query()->where('type', '!=', $type)->update(['enabled' => false]);
        $this->query()->where('type', '=', $type)->update(['enabled' => true]);

        return $this->refresh();
    }

    public function saveConfig(array $config, $type)
    {
        return self::updateOrCreate(
            ['type' => $type],
            ['config' => serialize($config)]
        );
    }

    public function getItexmoConfig()
    {
        return $this->query()->where('type', '=', self::TYPE_ITEXMO)->first();
    }

    public function getEmailConfig()
    {
        return $this->query()->where('type', '=', self::TYPE_EMAIL)->first();
    }

    public function getEnabled()
    {
        return $this->query()->where('enabled', '=', 1)->first();
    }
}
