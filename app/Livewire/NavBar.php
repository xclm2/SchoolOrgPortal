<?php
namespace App\Livewire;

use App\Models\User;
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

        /** @var User $user */
        $user = auth()->user();
        $organization = $user->getOrganization()?->id;
        return view('layouts.navbars.auth.nav', [
            'user' => Auth::user(),
            'notifications' => $user->notifications,
            'broadcast' => 'new_event_org_' . $organization,
            'new_member_broadcast' => 'new_member_org_' . $organization,
        ]);
    }
}
