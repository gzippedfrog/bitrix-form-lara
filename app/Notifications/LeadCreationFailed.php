<?php

namespace App\Notifications;

use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class LeadCreationFailed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     * @param array $data
     * @param object $error_response
     */
    public function __construct(
        public array  $data,
        public object $error_response
    )
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
     * Send a message about Lead creation error
     * to telegram channel/chat/user specified by TELEGRAM_CHAT_ID.
     *
     * @param $notifiable
     * @return TelegramMessage
     */
    public function toTelegram($notifiable): TelegramMessage
    {
        $error = $this->error_response->error;
        $description = $this->error_response->error_description;
        $data = $this->data;
        $name = "{$data['last_name']} {$data['first_name']} {$data['second_name']}";
        $phone = $data['phone'] ?? '-';
        $email = $data['email'] ?? '-';
        /** @var Carbon $birthdate */
        $birthdate = $data['birthdate']->format('d.m.Y');
        $message = $data['message'] ?? '-';

        return TelegramMessage::create()
            ->line("*Ошибка*")
            ->line("Не удалось создать новый лид\n")
            ->escapedLine("$error: $description\n")
            ->line("ФИО: $name")
            ->line("Тел: $phone")
            ->line("Email: $email")
            ->line("Дата рождения: $birthdate")
            ->line("Комментарий: $message");

    }
}
