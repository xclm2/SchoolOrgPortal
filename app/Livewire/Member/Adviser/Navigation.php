<?php
namespace App\Livewire\Member\Adviser;

use Livewire\Component;

class Navigation extends Component
{
    public $current = 'member.timeline';

    protected $pages = [
        'member.timeline',
        'member',
        'message',
        'settings',
        'create-organization'
    ];

    public function next()
    {
        $currentIndex = array_search($this->current, $this->pages);
        $this->current = $this->pages[$currentIndex + 1];
    }

    public function render()
    {
        return view('member.adviser.navigation');
    }
}
