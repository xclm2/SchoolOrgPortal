<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Models\User;
use App\Notifications\Notify;
use Illuminate\Console\Command;

class EventReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends reminder to organization member a day before event started';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $organizations = new Organization\Post();
        $events = $organizations->getEventsBeforeStart()->get();
        foreach ($events as $event) {
            /** @var Organization $organization */
            $organization = Organization::findOrFail($event->organization_id);
            $members = $organization->getMembers()->pluck('id');
            $users = User::whereIn('id', $members);
            $notify = new Notify();
            $notify->eventReminder($users, $organization, $event);
        }
    }
}
