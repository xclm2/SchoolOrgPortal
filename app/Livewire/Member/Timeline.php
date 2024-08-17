<?php

namespace App\Livewire\Member;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Timeline extends Component
{
    use WithPagination, WithoutUrlPagination;

    public Organization $organization;

    public function render()
    {
        $user = User::find(Auth::id());
        $this->organization = $user->getOrganization();
        return view('timeline', ['posts' => $this->organization->getPosts()->paginate(10)]);
    }
}
