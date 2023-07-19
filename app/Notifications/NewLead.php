<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class NewLead extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * @param Lead $lead
     */
    public function __construct(public Lead $lead)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param object $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Send a message about new Lead
     * to telegram channel/chat/user specified by TELEGRAM_CHAT_ID
     *
     * @param $notifiable
     * @return TelegramMessage
     */
    public function toTelegram($notifiable): TelegramMessage
    {
        $lead = $this->lead;
        $name = "$lead->last_name $lead->first_name $lead->second_name";
        $phone = $lead->phone ?? '-';
        $email = $lead->email ?? '-';
        $birthdate = $lead->birthdate ? $lead->birthdate->format('d.m.Y') : '-';
        $message = $lead->message ?? '-';

        return TelegramMessage::create()
            ->line("Новый лид")
            ->line("{$_ENV['BITRIX_URL']}/crm/lead/details/{$this->lead->bitrix_id}/\n")
            ->line("ФИО: $name")
            ->line("Тел: $phone")
            ->line("Email: $email")
            ->line("Дата рождения: $birthdate")
            ->line("Комментарий: $message");
    }
}
