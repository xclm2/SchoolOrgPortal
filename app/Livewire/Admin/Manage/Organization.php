<?php
namespace App\Livewire\Admin\Manage;

use App\Livewire\Admin\AbstractComponent;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Organization extends AbstractComponent
{
    use WithPagination, WithoutUrlPagination;
    public function render()
    {
        return view('admin.org-management', [
            'organizations' => \App\Models\Organization::leftJoin('courses' , 'organization.course_id' , '=' , 'courses.id')->selectRaw('organization.*, courses.name as course_name')->orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
