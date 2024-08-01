<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuratKerjaAssigned extends Notification
{
    use Queueable;

    private $surat;

    /**
     * Create a new notification instance.
     */
    public function __construct($surat)
    {
        $this->surat = $surat;
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
            ->subject('Penugasan Baru')
            ->greeting('Halo!')
            ->line('Anda telah ditugaskan surat kerja baru.')
            ->line('Nomor Surat: ' . $this->surat->nomor_surat_kerja)
            ->action('Lihat Surat Kerja', url('/suratkerjas/' . $this->surat->id))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'surat_id' => $this->surat->id,
            'nomor_surat' => $this->surat->nomor_surat_kerja,
            'message' => 'You have been assigned a new Surat Kerja.',
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
            'surat_id' => $this->surat->id,
            'nomor_surat' => $this->surat->nomor_surat_kerja,
        ];
    }
}
