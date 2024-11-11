<?php

namespace App\Events;

class NewMember extends AbstractBroadcast
{
    public function broadcastAs(): string
    {
        return 'new_member';
    }
}
