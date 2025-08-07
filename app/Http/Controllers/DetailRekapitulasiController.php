<?php

namespace App\Http\Controllers;

use App\Models\DetailRekapitulasi;
use App\Models\RekapitulasiPenduduk;
use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DetailRekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $id_laporan = $request->route('id');
        $laporanExists = RekapitulasiPenduduk::where('id_rekap', $id_laporan)->exists();

        if (!$laporanExists) {
            abort(404); // Akan menampilkan halaman 404
        }
        // $rtList = DetailRekapitulasi::where('id_rekap', $id_laporan)
        //     ->join('r_t_s', 'detail_rekapitulasis.id_rt', '=', 'r_t_s.id_rt')
        //     ->select('detail_rekapitulasis.*', 'r_t_s.nomor_rt')
        //     ->distinct()
        //     ->get();

        $datas = DetailRekapitulasi::where('id_rekap', $id_laporan)
            ->join('r_t_s', 'detail_rekapitulasis.id_rt', '=', 'r_t_s.id_rt')
            ->select(
                'r_t_s.id_rt',
                'r_t_s.nomor_rt',
                DB::raw('SUM(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total_penduduk_akhir'),
                DB::raw('SUM(jumlah_laki_laki_awal + jumlah_perempuan_awal) as total_penduduk_awal')
            )
            ->groupBy('r_t_s.id_rt', 'r_t_s.nomor_rt')
            ->get();
        $rtList = RT::all();
        // dd($rtList);
        return Inertia::render('DetailLaporanBulanan', [
            'datas' => $datas,
            'rtList' => $rtList,
            'id' => $id_laporan
        ]);
    }
    public function getByRT($idLaporan, $idRT)
    {
        $details = DetailRekapitulasi::where('id_rekap', $idLaporan)
            ->where('id_rt', $idRT)
            ->get();

        return response()->json($details);
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
        $validated = $request->validate([
            'id_rekap' => 'required|string|exists:rekapitulasi_penduduks,id_rekap',
            'id_rt' => 'required|string|exists:r_t_s,id_rt',
            'kelompok_umur' => 'required|string',
            'jumlah_laki_laki_awal' => 'required|integer|min:0',
            'jumlah_perempuan_awal' => 'required|integer|min:0',
            'jumlah_laki_laki_akhir' => 'required|integer|min:0',
            'jumlah_perempuan_akhir' => 'required|integer|min:0',
            'jumlah_laki_laki_pindah' => 'required|integer|min:0',
            'jumlah_perempuan_pindah' => 'required|integer|min:0',
            'jumlah_laki_laki_datang' => 'required|integer|min:0',
            'jumlah_perempuan_datang' => 'required|integer|min:0',
        ]);
        $validated['id_detail_rekap'] = time() . bin2hex(random_bytes(4));
        // dd($validated);
        DetailRekapitulasi::create($validated);

        return back()->with('success', 'Detail laporan berhasil ditambahkan');
    }

    public function getUsedAgeGroups($idRekap, $idRT)
    {
        $usedGroups = DetailRekapitulasi::where('id_rekap', $idRekap)
            ->where('id_rt', $idRT)
            ->pluck('kelompok_umur')
            ->toArray();

        return response()->json($usedGroups);
    }
    /**
     * Display the specified resource.
     */
    public function show(DetailRekapitulasi $detailRekapitulasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailRekapitulasi $detailRekapitulasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id_detail_rekap)
    {
        $detailRekap = DetailRekapitulasi::findOrFail($id_detail_rekap);

        $validated = $request->validate([
            'id_rekap' => 'required|string|exists:rekapitulasi_penduduks,id_rekap',
            'id_rt' => 'required|string|exists:r_t_s,id_rt',
            'kelompok_umur' => 'required|string',
            'jumlah_laki_laki_awal' => 'required|integer|min:0',
            'jumlah_perempuan_awal' => 'required|integer|min:0',
            'jumlah_laki_laki_akhir' => 'required|integer|min:0',
            'jumlah_perempuan_akhir' => 'required|integer|min:0',
            'jumlah_laki_laki_pindah' => 'required|integer|min:0',
            'jumlah_perempuan_pindah' => 'required|integer|min:0',
            'jumlah_laki_laki_datang' => 'required|integer|min:0',
            'jumlah_perempuan_datang' => 'required|integer|min:0',
        ]);

        $detailRekap->update($validated);

        return redirect()->back()->with('success', 'Data detail laporan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_detail_rekap)
    {
        // return redirect()->back()->withErrors([
        //     'messages' => 'Data detail laporan gagal dihapus'
        // ]);
        $detailRekap = DetailRekapitulasi::where('id_detail_rekap', $id_detail_rekap)->firstOrFail();
        $detailRekap->delete();

        return redirect()->back()->with('success', 'Data detail laporan berhasil dihapus');


    }
}
