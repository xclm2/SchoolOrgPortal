<?php
namespace App\Livewire\Admin\Manage;

use Livewire\Component;

class User extends Component
{
    public function render()
    {
        return view('admin.user-management', ['users' => \App\Models\User::orderBy('id', 'desc') ?? []]);
    }
}
