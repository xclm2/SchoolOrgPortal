<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE
    ];

    protected $table = 'organization';
    protected $fillable = [
        'name',
        'description',
        'logo',
        'banner',
        'adviser_id',
    ];
}
