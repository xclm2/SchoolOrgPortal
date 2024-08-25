<?php
namespace App\Livewire\Member\Adviser\Organization;

use App\Livewire\Member\AbstractMember;
use App\Models\Organization\Member;
use Livewire\WithPagination;

class Members extends AbstractMember
{
    use WithPagination;

    public function render()
    {
        return view('member.adviser.organization.members', [
            'members' => $this->getOrganization()->getMembers()->paginate(10, ['*'], 'active'),
            'pending' => $this->getOrganization()->getMembers(false)->paginate(10, ['*'], 'pending'),
        ]);
    }

    public function approve($id)
    {
        $member = Member::findOrFail($id);
        $member->status = Member::STATUS_ACTIVE;
        $member->save();

        $this->dispatch('member-approved');
    }

    public function deleteMember($id)
    {
        /** @var Member $member */
        $member = Member::findOrFail($id);
        $member->delete();

        $this->dispatch('member-removed');
    }
}
