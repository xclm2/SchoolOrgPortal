<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        switch (Auth::user()?->role) {
            case User::ROLE_ADVISER:
            case User::ROLE_STUDENT:
                return $this->redirect('/timeline', navigate: true);
            case User::ROLE_ADMIN:
                return $this->redirect('/admin', navigate: true);
            default;
                return $this->redirect('/login', navigate: true);
        }
    }
}
