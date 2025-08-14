<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailRekapitulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function pendudukIndex()
    {
        $pendudukDetail = DetailRekapitulasi::select(
            'kelompok_umur',
            'jumlah_laki_laki_akhir',
            'jumlah_perempuan_akhir',
            DB::raw('(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total_akhir'),
            DB::raw('(jumlah_laki_laki_datang + jumlah_perempuan_datang) as total_datang'),
            DB::raw('(jumlah_laki_laki_pindah + jumlah_perempuan_pindah) as total_pindah'),
        )->get();
        $summary = [
            'totalPenduduk' => $pendudukDetail->sum('total_akhir'),
            'totalLaki' => $pendudukDetail->sum('jumlah_laki_laki_akhir'),
            'totalPerempuan' => $pendudukDetail->sum('jumlah_perempuan_akhir'),          
        ];
        // dd($summary);
        return view("datapenduduk", [
            'penduduk' => array_map('number_format', $summary),
        ]);
    }    
}
