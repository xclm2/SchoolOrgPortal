<?php

namespace App\Livewire\Member;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function render()
    {
        return view ('admin.user-management.component.table', [
            'users' => User::paginate(15)
        ]);
    }
}
