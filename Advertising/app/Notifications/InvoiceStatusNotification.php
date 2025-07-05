<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceStatusNotification extends Notification
{
    use Queueable;

    public $status;
    public $invoiceId;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $invoiceId)
    {
        $this->status = $status;
        $this->invoiceId = $invoiceId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $statusText = $this->status === 'diterima' ? 'diterima' : 'ditolak';

        return (new MailMessage)
                    ->subject('Status Invoice Anda')
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line("Invoice dengan ID: {$this->invoiceId} telah *$statusText* oleh admin.")
                    ->action('Lihat Invoice', url(route('profile.invoice')))
                    ->line('Terima kasih telah menggunakan layanan kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
