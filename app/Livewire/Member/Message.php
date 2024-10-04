<?php
namespace App\Livewire\Member;

use App\Events\Messaging;
use App\Models\Organization\Messages;
use Illuminate\Mail\Events\MessageSent;
use App\Models\User;

class Message extends AbstractMember
{
    public string $message = '';
    public function render()
    {
        $organizationId = $this->getOrganization()->id;
        $messages = Messages::where('organization_id', $organizationId)->orderBy('created_at', 'asc')->paginate(100);
        return view('member.message', [
            'broadcast_on' => 'bcc_org_message_' . $organizationId,
            'organization_id' => $organizationId,
            'messages' => $messages,
            'user' => $this->getCurrentUser(),
        ]);
    }

    public function loadMessage($message, $self = false)
    {
        $messageData = [
            'message' => $message->message,
            'user_avatar' => $this->getAvatar($message->user_id),
            'sent_at' => date('h:i A', strtotime($message->created_at)),
        ];

        if ($self) {
            $user = User::find($message->user_id);
            $messageData['user_name'] = $user->name . ' ' . $user->lastname;
            return view ('member.message.receive', ['data' => $messageData]);
        }

        return view ('member.message.broadcast', ['data' => $messageData]);
    }
}
