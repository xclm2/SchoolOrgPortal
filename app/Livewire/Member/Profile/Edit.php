<?php
namespace App\Livewire\Member\Profile;

use Livewire\Component;

class Edit extends Component
{
    public $name;
    public $lastname;
    public $phone;
    public $email;

    public function mount()
    {

    }

    public function render()
    {
        return view('member.profile.edit');
    }
}
