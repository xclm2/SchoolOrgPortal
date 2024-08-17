<?php
namespace App\Livewire\Admin\Manage;

use Livewire\Component;

#[Lazy]
class User extends Component
{
    public function render()
    {
        return view('admin.user-management', ['users' => \App\Models\User::all() ?? []]);
    }
}
