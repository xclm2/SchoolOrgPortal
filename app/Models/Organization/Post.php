<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    protected $table = 'organization_post';

    protected $fillable = [
        'organization_id',
        'member_id',
        'post',
        'start_date',
        'end_date',
        'notify_member',
        'title'
    ];

    public function getPost(): Builder
    {
        return DB::table('organization_post')
            ->join('organization', 'organization.id', '=', 'organization_post.organization_id')
            ->selectRaw('organization_post.*, organization.name')
            ->whereRaw('start_date >= DATE(NOW())')
            ->orderBy('start_date', 'ASC');
    }
}
