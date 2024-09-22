<?php
namespace App\Livewire\Member;

use App\Livewire\Admin\AbstractComponent;
use App\Models\Organization;

class Join extends AbstractComponent
{
    public function render()
    {
        $organizations = Organization::all()->where('status', '=', Organization::STATUS_ACTIVE);
        return view('member.join', [
            'organizations' => $organizations,
            'course_id' => auth()->user()->course_id
        ]);
    }
}
