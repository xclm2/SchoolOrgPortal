<?php
namespace App\Livewire\Member\Events\View;

use App\Livewire\Member\AbstractMember;

class Calendar extends AbstractMember
{
    public $events;
    public function mount()
    {
        $data = [];
        $events = $this->getOrganization()->getPosts()->get();
        foreach ($events as $event) {
            $endDate = $event->end_date ?? $event->start_date;
            if (date('Y-m-d') >= $endDate) {
                $className = 'bg-gradient-danger';
            } elseif ($event->start_date == date('Y-m-d') && $endDate <= date('Y-m-d')) {
                $className = 'bg-gradient-success';
            } else {
                $className = 'bg-gradient-primary';
            }

            $data[] = [
                'title' => $event->title,
                'start' => $event->start_date,
                'end' => $endDate,
                'className' => $className
            ];
        }

        $this->events = json_encode($data);
    }
    public function render()
    {
        return view('member.events.view.calendar');
    }
}
