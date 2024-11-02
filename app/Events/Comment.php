<?php

namespace App\Events;

class Comment extends AbstractBroadcast
{
    public function broadcastAs(): string
    {
        return 'comment';
    }
}
