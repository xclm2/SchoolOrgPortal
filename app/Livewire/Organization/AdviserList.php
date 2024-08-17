<?php

namespace App\Livewire\Organization;

use App\Models\User;
use Livewire\Component;

class AdviserList extends Component
{
    public function render()
    {
        $advisers = User::where('role', User::ROLE_ADVISER)->paginate(10);
        return view('admin.org-management.component.adviser-list',['advisers' => $advisers]);
    }
}
