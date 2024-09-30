<?php
namespace App\Livewire\Member\Adviser\Organization;

use App\Livewire\Member\AbstractMember;
use App\Models\Organization\Member;
use App\Notifications\Organization\NewMember;
use Livewire\WithPagination;

class Members extends AbstractMember
{
    use WithPagination;

    public function render()
    {
        return view('member.adviser.organization.members', [
            'members' => $this->getOrganization()->getMembers()->paginate(10, ['*'], 'active'),
            'pending' => $this->getOrganization()->getMembers(false)->paginate(10, ['*'], 'pending'),
            'new_members' => $this->_getNewMembers(),
        ]);
    }

    public function approve($id): void
    {
        $member = Member::findOrFail($id);
        $member->status = Member::STATUS_ACTIVE;
        $member->save();

        $this->dispatch('member-approved');
    }

    public function deleteMember($id): void
    {
        /** @var Member $member */
        $member = Member::findOrFail($id);
        $member->delete();

        $this->dispatch('member-removed');
    }

    protected function _getNewMembers(): array
    {
        $notifications = $this->getCurrentUser()->unreadNotifications()
            ->where('read_at', null)
            ->where('type', NewMember::class)->get();

        $newMembers = [];
        foreach ($notifications as $notification) {
            if (! isset($notification->data['member_user_id'])) {
                continue;
            }

            $newMembers[] = $notification->data['member_user_id'];
        }

        $notifications->markAsRead();
        return $newMembers;
    }
}
