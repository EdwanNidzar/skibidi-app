<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaporanPelanggaranCreated extends Notification
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
            ->subject('Laporan Pelanggaran Baru')
            ->greeting('Halo!')
            ->line('Laporan pelanggaran baru telah dibuat.')
            ->line('Jenis Pelanggaran: ' . $this->laporan->pelanggaran->jenisPelanggaran->jenis_pelanggaran)
            ->line('Nama Partai: ' . $this->laporan->pelanggaran->parpol->parpol_name)
            ->line('Nama Peserta Pemilu: ' . $this->laporan->pelanggaran->nama_bacaleg)
            ->action('Lihat Laporan', url('/laporanpelanggarans/' . $this->laporan->id))
            ->line('Terima kasih atas perhatian Anda!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'laporan_id' => $this->laporan->id,
            'pelanggaran' => $this->laporan->pelanggaran->jenisPelanggaran->jenis_pelanggaran,
            'parpol' => $this->laporan->pelanggaran->parpol->parpol_name,
            'nama_bacaleg' => $this->laporan->pelanggaran->nama_bacaleg,
            'message' => 'Laporan pelanggaran baru telah dibuat.',
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
            'pelanggaran' => $this->laporan->pelanggaran->jenisPelanggaran->jenis_pelanggaran,
            'parpol' => $this->laporan->pelanggaran->parpol->parpol_name,
            'nama_bacaleg' => $this->laporan->pelanggaran->nama_bacaleg,
        ];
    }
}
