<?php

namespace App\Models\Organization;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Member extends Model
{
    use HasFactory, Notifiable;

    const STATUS_ACTIVE  = 'active';
    const STATUS_PENDING = 'pending';

    protected $table = 'organization_member';
    protected $fillable = [
        'organization_id',
        'user_id',
        'status'
    ];

    public function getOrganization()
    {
        return Organization::find($this->organization_id);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->firstOrFail();
    }
}
