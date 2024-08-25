<?php

namespace App\Livewire\Member;

use App\Models\Organization;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Events extends AbstractMember
{
    use WithPagination, WithoutUrlPagination;

    public Organization $organization;

    public function render()
    {
        return view('events', [
            'organization' => $this->getOrganization(),
            'banner' => $this->getBanner($this->getOrganization()->id)
        ]);
    }
}
