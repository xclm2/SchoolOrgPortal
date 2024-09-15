<?php
namespace App\Livewire\Member\Adviser\Organization;

use App\Livewire\Member\Profile;
use Illuminate\Support\Facades\Auth;

class Edit extends \App\Livewire\Admin\Manage\Organization\Edit
{
    public bool $isAdmin = false;

    public function mount($id = null)
    {
        $profile = new Profile();
        parent::mount($profile->getOrganization()->id);
        $this->adviser_id = Auth::user()->id;
    }
}
