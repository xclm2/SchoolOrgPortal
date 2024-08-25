<?php
namespace App\Livewire\Admin;

use App\Models\Organization;
use App\Models\User;

class Dashboard extends AbstractComponent
{
    public function render()
    {
        $totalEvents = Organization::all()->count();
        $totalUsers  = User::all()->count();
        $events = new Organization\Post();
        $upcomingEvents = $events->getPost();
        return view('dashboard', [
            'totalEvents' => Organization\Post::all()->count(),
            'totalUsers' => $totalUsers,
            'totalOrganizations' => Organization::all()->count(),
            'upcomingEvents' => $upcomingEvents->paginate(100),
            'organizations' => Organization\Post::paginate(5)
        ]);
    }
}
