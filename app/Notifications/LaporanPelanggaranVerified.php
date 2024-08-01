<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaporanPelanggaranVerified extends Notification
{
    use Queueable;

    private $laporan;

    /**
     * Create a new notification instance.
     */
    public function __construct($laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Laporan Pelanggaran Diverifikasi')
            ->greeting('Halo!')
            ->line('Laporan pelanggaran Anda telah diverifikasi.')
            ->action('Lihat Laporan', url('/laporanpelanggarans/' . $this->laporan->id))
            ->line('Terima kasih atas partisipasi Anda!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'laporan_id' => $this->laporan->id,
            'message' => 'Laporan pelanggaran Anda telah diverifikasi.',
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'laporan_id' => $this->laporan->id,
        ];
    }
}
