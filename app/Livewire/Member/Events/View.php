<?php
namespace App\Livewire\Member\Events;

use App\Models\Organization;
use Livewire\Component;

class View extends Component
{
    public $current = 'member.events.view.listView';

    public Organization $organization;

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function getView($view)
    {
        $this->current = ($view == 'calendar') ? 'member.events.view.calendar' : 'member.events.view.listView';
    }

    public function render()
    {
        return view('member.events.view', ['organization' => $this->organization]);
    }

    public function dehydrate()
    {
        $test = 1;
    }
}
