<?php

namespace App\Observers;

use App\Models\DetailRekapitulasi;
use App\Models\RekapitulasiRT;

class DetailRekapitulasiObserver
{
    /**
     * Handle the DetailRekapitulasi "created" event.
     */
    public function created(DetailRekapitulasi $detailRekapitulasi): void
    {
        
        $this->recalculate($detailRekapitulasi->rekapitulasiRT);
    }

    /**
     * Handle the DetailRekapitulasi "updated" event.
     */
    public function updated(DetailRekapitulasi $detailRekapitulasi): void
    {
        //
    }

    /**
     * Handle the DetailRekapitulasi "deleted" event.
     */
    public function deleted(DetailRekapitulasi $detailRekapitulasi): void
    {
        $this->recalculate($detailRekapitulasi->rekapitulasiRT);
    }

    /**
     * Handle the DetailRekapitulasi "restored" event.
     */
    public function restored(DetailRekapitulasi $detailRekapitulasi): void
    {
        //
    }

    /**
     * Handle the DetailRekapitulasi "force deleted" event.
     */
    public function forceDeleted(DetailRekapitulasi $detailRekapitulasi): void
    {
        //
    }
    private function recalculate(RekapitulasiRT $rekapRT)
    {
        $details = $rekapRT->detailRekapitulasi;

        $rekapRT->update([
            'jumlah_kk' => $details->sum('jumlah_kk'),
            'jumlah_penduduk_akhir' =>
                $details->sum('jumlah_laki_laki_akhir') +
                $details->sum('jumlah_perempuan_akhir'),
        ]);
    }
}
