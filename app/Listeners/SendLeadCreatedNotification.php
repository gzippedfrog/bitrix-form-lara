<?php

namespace App\Listeners;

use App\Events\LeadCreated;
use App\Notifications\NewLead;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendLeadCreatedNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     * @param LeadCreated $event
     */
    public function handle(LeadCreated $event): void
    {
        Notification::route('telegram', $_ENV['TELEGRAM_CHAT_ID'])
            ->notify(new NewLead($event->lead));
    }
}
