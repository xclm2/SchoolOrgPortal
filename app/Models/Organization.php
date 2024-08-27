<?php

namespace App\Models;

use App\Models\Organization\Member;
use App\Models\Organization\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'course_id',
    ];

    public function getLogo()
    {
        return asset("storage/logo/org-{$this->id}.jpg");
    }

    public function getBanner() {
        return asset("storage/banner/org-{$this->id}.jpg");
    }

    public function getPosts()
    {
        return $this->hasMany(Post::class)
            ->join('organization_member','organization_member.id','=','organization_post.member_id')
            ->join('users','users.id','=','organization_member.user_id')
            ->selectRaw('organization_post.*, users.id as user_id, users.name, users.lastname')
            ->orderBy('created_at', 'desc');
    }

    public function getMembers(bool $active = true)
    {
        return $this->hasMany(Member::class)
            ->join('users','users.id','=','organization_member.user_id')
            ->selectRaw('organization_member.created_at AS date_requested, organization_member.updated_at AS joined_at, organization_member.status, organization_member.id as member_id, users.*')
            ->where('organization_member.status', ($active) ? Member::STATUS_ACTIVE : Member::STATUS_PENDING)
            ->where('users.role', '!=', User::ROLE_ADVISER);
    }

    public function getAllMembers()
    {
        return $this->hasMany(Member::class)
            ->join('users','users.id','=','organization_member.user_id')
            ->selectRaw('organization_member.created_at AS date_requested, organization_member.updated_at AS joined_at, organization_member.status, organization_member.id as member_id, users.*');
    }
}
