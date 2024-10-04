<?php
namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Messages extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'organization_messages';
    protected $fillable = [
        'organization_id',
        'message',
        'user_id',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
