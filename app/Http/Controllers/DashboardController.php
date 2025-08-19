<?php

namespace App\Http\Controllers;

use App\Models\DetailRekapitulasi;
use App\Models\RekapitulasiPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendudukDetail = DetailRekapitulasi::select(
            'id_rt',
            'kelompok_umur',
            'jumlah_laki_laki_akhir',
            'jumlah_perempuan_akhir',
            'jumlah_laki_laki_datang',
            'jumlah_perempuan_datang',
            'jumlah_laki_laki_pindah',
            'jumlah_perempuan_pindah',
            DB::raw('(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total_akhir'),
            DB::raw('(jumlah_laki_laki_datang + jumlah_perempuan_datang) as total_datang'),
            DB::raw('(jumlah_laki_laki_pindah + jumlah_perempuan_pindah) as total_pindah'),
        )->get();

        // Get aggregated data by age group
        $pendudukByUmur = DetailRekapitulasi::select(
            'kelompok_umur',
            DB::raw('SUM(jumlah_laki_laki_akhir) as total_laki'),
            DB::raw('SUM(jumlah_perempuan_akhir) as total_perempuan'),
            DB::raw('SUM(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total'),
            DB::raw('ROUND(SUM(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) / 
           (SELECT SUM(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) 
            FROM detail_rekapitulasis) * 100, 2) as percentage')
        )
            ->groupBy('kelompok_umur')
            ->addSelect(DB::raw("
                CASE
                    WHEN kelompok_umur LIKE '>%' THEN 
                        CAST(SUBSTRING(kelompok_umur, 2) AS UNSIGNED) + 1
                    ELSE 
                        CAST(SUBSTRING_INDEX(kelompok_umur, '-', 1) AS UNSIGNED)
                END as age_sort
            "))
            ->orderBy('age_sort')
            ->get();

        $pendudukByBulan =  DetailRekapitulasi::join('rekapitulasi_penduduks', 'detail_rekapitulasis.id_rekap', '=', 'rekapitulasi_penduduks.id_rekap')
    ->select(
        'rekapitulasi_penduduks.bulan',
        'rekapitulasi_penduduks.tahun',
        
        DB::raw('SUM(jumlah_laki_laki_akhir) as total_laki'),
        DB::raw('SUM(jumlah_perempuan_akhir) as total_perempuan'),
        DB::raw('SUM(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total_akhir'),
        DB::raw('SUM(jumlah_laki_laki_datang + jumlah_perempuan_datang) as total_datang'),
        DB::raw('SUM(jumlah_laki_laki_pindah + jumlah_perempuan_pindah) as total_pindah')
    )
    ->groupBy('rekapitulasi_penduduks.bulan', 'rekapitulasi_penduduks.tahun') // Group by bulan dan tahun
    ->orderBy('rekapitulasi_penduduks.tahun')
    ->orderByRaw("
        CASE 
            WHEN bulan = 'Januari' THEN 1
            WHEN bulan = 'Februari' THEN 2
            WHEN bulan = 'Maret' THEN 3
            WHEN bulan = 'April' THEN 4
            WHEN bulan = 'Mei' THEN 5
            WHEN bulan = 'Juni' THEN 6
            WHEN bulan = 'Juli' THEN 7
            WHEN bulan = 'Agustus' THEN 8
            WHEN bulan = 'September' THEN 9
            WHEN bulan = 'Oktober' THEN 10
            WHEN bulan = 'November' THEN 11
            WHEN bulan = 'Desember' THEN 12
        END
    ")
    ->get();
        // dd($pendudukByBulan);

        // Calculate summary statistics
        $summary = [
            'totalPenduduk' => $pendudukDetail->sum('total_akhir'),
            'totalLaki' => $pendudukDetail->sum('jumlah_laki_laki_akhir'),
            'totalPerempuan' => $pendudukDetail->sum('jumlah_perempuan_akhir'),
            'totalDatang' => $pendudukDetail->sum('total_datang'),
            'totalPindah' => $pendudukDetail->sum('total_pindah'),
            'lakiDatang' => $pendudukDetail->sum('jumlah_laki_laki_datang'),
            'perempuanDatang' => $pendudukDetail->sum('jumlah_perempuan_datang'),
            'lakiPindah' => $pendudukDetail->sum('jumlah_laki_laki_pindah'),
            'perempuanPindah' => $pendudukDetail->sum('jumlah_perempuan_pindah'),
            'growthRate' => $pendudukDetail->sum('total_datang') - $pendudukDetail->sum('total_pindah'),
            'genderRatio' => $pendudukDetail->sum('jumlah_perempuan_akhir') /
                max(1, $pendudukDetail->sum('jumlah_laki_laki_akhir'))
        ];
        // dd($pendudukByBulan);

        $lastUpdated = DetailRekapitulasi::latest('updated_at')->value('updated_at');

        return Inertia::render('Dashboard', [
            'detailData' => $pendudukDetail->map(function ($item) {
                return [
                    // 'rt' => $item->id_rt,
                    'kelompok_umur' => $item->kelompok_umur,
                    'laki_akhir' => number_format($item->jumlah_laki_laki_akhir),
                    'perempuan_akhir' => number_format($item->jumlah_perempuan_akhir),
                    'total_akhir' => number_format($item->total_akhir),
                    'laki_datang' => number_format($item->jumlah_laki_laki_datang),
                    'perempuan_datang' => number_format($item->jumlah_perempuan_datang),
                    'laki_pindah' => number_format($item->jumlah_laki_laki_pindah),
                    'perempuan_pindah' => number_format($item->jumlah_perempuan_pindah),
                ];
            }),
            'ageGroups' => $pendudukByUmur->map(function ($item) {
                return [
                    'kelompok_umur' => $item->kelompok_umur,
                    'laki' => number_format($item->total_laki),
                    'perempuan' => number_format($item->total_perempuan),
                    'total' => number_format($item->total),
                    'percentage' => $item->percentage
                ];
            }),
            'summary' => array_map('number_format', $summary),
            'lastUpdated' => $lastUpdated ? \Carbon\Carbon::parse($lastUpdated)->format('d F Y H:i') : '',
            'pendudukByBulan' => $pendudukByBulan->map(function ($item) {
                return [
                    'bulan' => $item->bulan,
                    'tahun' => $item->tahun,
                    'totalLaki' => $item->total_laki,
                    'totalPerempuan' => $item->total_perempuan,
                    'totalPenduduk' => $item->total_akhir,
                    'totalDatang' => $item->total_datang,
                    'totalPindah' => $item->total_pindah
                ];
            }),
            // 'lastUpdated' => ""

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
