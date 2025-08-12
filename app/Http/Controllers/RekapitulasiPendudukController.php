<?php

namespace App\Http\Controllers;

use App\Models\DetailRekapitulasi;
use App\Models\RekapitulasiPenduduk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RekapitulasiPendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    return Inertia::render('LaporanBulanan', [
        'datas' => RekapitulasiPenduduk::orderByRaw("
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
        ->orderBy('tahun')
        ->get(),
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
        $validatedData = $request->validate([
            'bulan' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);
        $validatedData['id_rekap'] = 'LPDB-' . $validatedData["tahun"] ."-". bin2hex(random_bytes(4));

        RekapitulasiPenduduk::create($validatedData);
        // Redirect or return a response
        return redirect()->back()->with('success', 'Laporan berhasil ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(RekapitulasiPenduduk $rekapitulasiPenduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RekapitulasiPenduduk $rekapitulasiPenduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $laporan)
    {
        $laporanData = RekapitulasiPenduduk::findOrFail($laporan);

        $validatedData = $request->validate([
            'bulan' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);
        $laporanData->update($validatedData);

        return redirect()->back()->with('success','berhasil update');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id_rekap)
{
    $rekap = RekapitulasiPenduduk::with('details')->where('id_rekap', $id_rekap)->firstOrFail();

    // Hapus semua detail dulu
    $rekap->details()->delete();

    // Hapus rekap utama
    $rekap->delete();

    return redirect()->back()->with('success', 'Data laporan berhasil dihapus');
}
}
