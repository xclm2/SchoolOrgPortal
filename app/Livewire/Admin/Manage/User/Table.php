<?php

namespace App\Livewire\Admin\Manage\User;

use App\Livewire\Admin\AbstractComponent;
use App\Models\User;
use Livewire\WithPagination;

class Table extends AbstractComponent
{
    use WithPagination;

    public function render()
    {
        return view ('admin.user-management.list', [
            'users' => User::join('courses' , 'users.course_id' , '=' , 'courses.id')->selectRaw('users.*, courses.name as course_name')->orderBy('id', 'desc')->paginate(10)
        ]);
    }
}
