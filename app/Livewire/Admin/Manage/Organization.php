<?php
namespace App\Livewire\Admin\Manage;

class Organization extends \Livewire\Component
{
    public function render()
    {
        return view('admin.org-management', ['organizations' => \App\Models\Organization::paginate(10)]);
    }
}
