<?php
namespace App\Livewire\Member\Adviser;

use App\Livewire\Member\AbstractMember;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Home extends AbstractMember
{
    use WithPagination, WithoutUrlPagination;
    public function render()
    {
        $organization = $this->getOrganization();
        return view('events', ['organization' => $organization, 'banner' => $this->getBanner($organization->id)]);
    }
}
