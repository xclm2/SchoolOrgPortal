<?php

namespace App\Events;

class NewEvent extends AbstractBroadcast
{
    public function broadcastAs(): string
    {
        return 'new_event';
    }
}
