<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public function mount()
    {
        if (Auth::check()) {
            switch (Auth::user()?->role) {
                case User::ROLE_ADVISER:
                    return redirect('/adviser');
                case User::ROLE_STUDENT:
                    return redirect('/member');
                case User::ROLE_ADMIN:
                    return redirect('/admin');
                default:

            }
        }

        return redirect('/login');
    }

    public function render()
    {
        return view('welcome');
    }
}
