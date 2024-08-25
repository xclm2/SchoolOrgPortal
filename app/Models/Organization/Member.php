<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    const STATUS_ACTIVE  = 'active';
    const STATUS_PENDING = 'pending';

    protected $table = 'organization_member';
    protected $fillable = [
        'organization_id',
        'user_id',
        'status'
    ];
}