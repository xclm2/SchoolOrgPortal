<?php

namespace App\Models;

use App\Models\Organization\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Lazy]
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

    public function getLogo()
    {
        return asset("storage/logo/org-{$this->id}.jpg");
    }

    public function getBanner() {
        return asset("storage/banner/org-{$this->id}.jpg");
    }

    public function getPosts()
    {
        return Post::where('organization_id', $this->id);
    }
}
