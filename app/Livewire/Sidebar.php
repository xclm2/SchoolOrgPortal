<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners = ['refreshSidebar' => '$refresh'];

    public function render()
    {
        $user = Auth::user();
        $data = [];
        $view = match ($user?->getAttribute('role')) {
            'admin' => 'layouts.navbars.auth.sidebar',
            'student' => 'layouts.navbars.auth.student-sidebar',
            'adviser' => 'layouts.navbars.auth.adviser-sidebar',
            default => '',
        };

        switch ($user?->getAttribute('role')) {
            case User::ROLE_ADVISER:
                $notification = $user->notifications->where('read_at', null)->where('type', \App\Notifications\Organization\NewMember::class);
                $data['new_members_count'] = $notification->count();
                break;
            case User::ROLE_STUDENT:
                $notification = $user->getMember()->notifications->where('read_at', null)->where('type', \App\Notifications\Post::class);
                $data['new_posts'] = $notification->count();
                break;
            case User::ROLE_ADMIN:
                $notification = $user->notifications->where('read_at', null)->where('type', \App\Notifications\Organization::class);
                $data['new_organization_count'] = $notification->count();
                break;
        }

        return view($view, $data);
    }
}
