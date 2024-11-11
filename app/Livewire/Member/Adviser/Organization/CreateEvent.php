<?php
namespace App\Livewire\Member\Adviser\Organization;

use App\Livewire\Member\AbstractMember;
use App\Models\Organization;
use App\Models\User;
use App\Notifications\Notify;

class CreateEvent extends AbstractMember
{
    public Organization $organization;
    public string $post;
    public string $title;
    public string $images;
    public string $start_date;
    public ?string $end_date;
    public $event_date;
    public function save()
    {
        $validated = $this->validate();
        $validated['organization_id'] = $this->getOrganization()->id;
        $validated['member_id'] = $this->getMember()->id;
        $validated['start_date'] = $this->start_date;
        $validated['end_date'] = $this->end_date;
        /** @var Organization\Post $post */
        $post = \App\Models\Organization\Post::create($validated);

        $messaging = new \App\Events\NewEvent('new_event_org_' . $validated['organization_id'], json_encode($post->toArray()));
        broadcast($messaging)->toOthers();
        $members = $this->getOrganization()->getMembers()->pluck('id');

        $users = User::whereIn('id', $members);

        $notify = new Notify();
        $notify->newEvent($users, $this->getOrganization(), $post);

        $this->post = '';
        $this->title = '';
        $this->event_date = '';

        $this->dispatch('event-created');
    }

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function rules()
    {
        return [
            'post' => 'required',
            'title' => 'required',
            'event_date' => [
                'required',
                function (string $attribute, $value, \Closure $fail) {
                    $values = explode(' to ', $value);
                    $this->start_date = $values[0];
                    $this->end_date = $values[1] ?? null;
                    if (! is_null($this->end_date) && $this->end_date < $this->start_date) {
                        $fail('End date must be greater than the start date.');
                    }
                }
            ],
        ];
    }

    public function render()
    {
        return view('member.adviser.organization.create-event');
    }
}
