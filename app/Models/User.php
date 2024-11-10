<?php

namespace App\Models;

use App\Models\Organization\Member as OrganizationMember;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    const STATUS_PENDING = 'pending';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const ROLE_ADMIN = 'admin';
    const ROLE_STUDENT = 'student';
    const ROLE_ADVISER = 'adviser';

    const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_ACTIVE,
        self::STATUS_INACTIVE,
    ];

    const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_STUDENT,
        self::ROLE_ADVISER,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
        'role',
        'course_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getMember()
    {
        return $this->hasOne(OrganizationMember::class)->first();
    }

    public function getOrganization(): Organization
    {
        if ($this->role == self::ROLE_STUDENT && $member = $this->getMember()) {
            return Organization::find($member->organization_id);
        } else if ($this->role == self::ROLE_ADVISER) {
            if ($organization = Organization::where('adviser_id', $this->id)->first()) {
                return $organization;
            }

            return new Organization();
        }

        return new Organization();
    }

    public function getFullname()
    {
        return $this->name . ' ' . $this->lastname;
    }

    public static function getUsersByRole($role): Collection
    {
        if (! in_array($role, self::ROLES)) {
            throw new \InvalidArgumentException("Invalid role");
        }

        return self::where('role', $role)->get();
    }
}
