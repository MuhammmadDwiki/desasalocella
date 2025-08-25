<?php

namespace App\Notifications;

use App\Models\RekapitulasiRT;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaporanStatusChanged extends Notification 
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public RekapitulasiRT $rekap,
        public string $newStatus,
        public ?string $catatan = null
    ) {}


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database']; // atau hanya 'database'
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
         return [
            'type'      => 'laporan-status',
            'rekap_id'    => $this->rekap->id_rekap_rt,
            'nomor_rt'          => $this->rekap->rt->nomor_rt,
            'bulan' => $this->rekap->rekapitulasi->bulan,
            'tahun' => $this->rekap->rekapitulasi->tahun,
            'new_status' => $this->newStatus,
            'catatan'   => $this->catatan,
            'link'      => route('laporans.show', [
                'id_rekap' => $this->rekap->id_rekap
            ]),
        ];
    }
}
