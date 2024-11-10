<?php
namespace App\Livewire;

use App\Models\Organization;
use App\Models\User;
use App\Sms\Provider\Itexmo;
use App\Sms\Provider\Semaphore;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public string $email;

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
                    break;
            }
        }
    }
    public function render()
    {
        $events = new Organization\Post();
        $upcomingEvents = $events->getPost();
        return view('welcome', [
            'upcomingEvents' => $upcomingEvents->paginate(6)
        ]);
    }

    public function forgotPassword()
    {

    }
}
