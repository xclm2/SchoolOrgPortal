<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Organization;
class Counter extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter',['organizations' => Organization::paginate(1)]);
    }
}
