<?php

namespace App\Events;

class Messaging extends AbstractBroadcast
{
    public function broadcastAs(): string
    {
        return 'chat';
    }
}
