<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'organization_post_comment';
    protected $fillable = [
        'post_id',
        'member_id',
        'status',
        'comment',
    ];
}
