<?php

namespace App\Listeners;

use App\Events\LeadNotCreated;
use App\Notifications\LeadCreationFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendLeadNotCreatedNotification implements ShouldQueue
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
     * @param LeadNotCreated $event
     */
    public function handle(LeadNotCreated $event): void
    {
        Notification::route('telegram', $_ENV['TELEGRAM_CHAT_ID'])
            ->notify(new LeadCreationFailed($event->data, $event->error_response));
    }
}
