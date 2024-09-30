<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;

class NavBar extends Component
{
    use WithoutUrlPagination;

    public function render()
    {
        if (! Auth::check()) {
            return view('layouts.navbars.guest.nav');
        }

        $notifications = auth()->user()->notifications;
        return view('layouts.navbars.auth.nav', [
            'user' => Auth::user(),
            'notifications' => $notifications,
        ]);
    }
}
