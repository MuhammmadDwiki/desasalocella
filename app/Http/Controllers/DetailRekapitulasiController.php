<?php

namespace App\Http\Controllers;

use App\Models\DetailRekapitulasi;
use App\Models\RekapitulasiPenduduk;
use App\Models\RekapitulasiRT;
use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
                DB::raw('SUM(jumlah_kk) as total_kk'),
                DB::raw('SUM(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total_penduduk_akhir'),
                DB::raw('SUM(jumlah_laki_laki_awal + jumlah_perempuan_awal) as total_penduduk_awal')
            )
            ->groupBy('r_t_s.id_rt', 'r_t_s.nomor_rt')
            ->get();
        $rtList = RT::orderBy("nomor_rt")->get();
        // dd($datas);
        // return Inertia::render('DetailLaporanBulanan', [
        //     'datas' => $datas,
        //     'rtList' => $rtList,
        //     'id' => $id_laporan
        // ]);
    }
    public function getByRT($id_rekap_rt)
    {
        // dd($id_rekap_rt);
        $details = DetailRekapitulasi::where('id_rekap_rt', $id_rekap_rt)
                             ->get();
            // ->where('id_rt', $idRT)

        return response()->json($details);
    }

    public function getUsedAgeGroups($id_rt, $id_rekap)
    {
        $id_rekap_rt = RekapitulasiRT::select('id_rekap_rt')->where([
            'id_rt' => $id_rt,
            'id_rekap' => $id_rekap
            ])->first();
        
        $usedGroups = DetailRekapitulasi::where('id_rekap_rt', '=',$id_rekap_rt)
                    ->pluck('kelompok_umur')
                    ->toArray();
            // ->where('id_rt', $idRT)

        return response()->json($usedGroups);
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
        $user = Auth::user();
        $name = $user['name'];
        $status = $user->role === 'super_admin' ? 'approved' : 'draft';

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
            'jumlah_kk' => 'required|integer|min:0',
        ]);
        $idRekapRt = 'RRT-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));

        $rekapRT = RekapitulasiRT::firstOrCreate(
                    [
                        'id_rekap' => $validated['id_rekap'],
                        'id_rt'    => $validated['id_rt'],
                    ],
                    [
                        'id_rekap_rt' => $idRekapRt,
                        'jumlah_kk'             => 0,
                        'jumlah_penduduk_akhir' => 0,
                        'status'                => $status,
                        'submitted_by'          => Auth::id(),
                    ]
                );
        // dd($validated, Auth::id());

        DetailRekapitulasi::create([
            'id_detail_rekap' => time() . bin2hex(random_bytes(4)),
            'id_rekap_rt'     => $rekapRT->id_rekap_rt,
            'kelompok_umur'   => $validated['kelompok_umur'],
            'jumlah_kk'                   => $validated['jumlah_kk'],
            'jumlah_laki_laki_awal'       => $validated['jumlah_laki_laki_awal'],
            'jumlah_perempuan_awal'       => $validated['jumlah_perempuan_awal'],
            'jumlah_laki_laki_akhir'      => $validated['jumlah_laki_laki_akhir'],
            'jumlah_perempuan_akhir'      => $validated['jumlah_perempuan_akhir'],
            'jumlah_laki_laki_pindah'     => $validated['jumlah_laki_laki_pindah'],
            'jumlah_perempuan_pindah'     => $validated['jumlah_perempuan_pindah'],
            'jumlah_laki_laki_datang'     => $validated['jumlah_laki_laki_datang'],
            'jumlah_perempuan_datang'     => $validated['jumlah_perempuan_datang'],
        ]);


        return back()->with('success', 'Detail laporan berhasil ditambahkan');
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
            'id_rekap_rt' => 'required|string|exists:rekapitulasi_r_t_s,id_rekap_rt',
            'kelompok_umur' => 'required|string',
            'jumlah_laki_laki_awal' => 'required|integer|min:0',
            'jumlah_perempuan_awal' => 'required|integer|min:0',
            'jumlah_laki_laki_akhir' => 'required|integer|min:0',
            'jumlah_perempuan_akhir' => 'required|integer|min:0',
            'jumlah_laki_laki_pindah' => 'required|integer|min:0',
            'jumlah_perempuan_pindah' => 'required|integer|min:0',
            'jumlah_laki_laki_datang' => 'required|integer|min:0',
            'jumlah_perempuan_datang' => 'required|integer|min:0',
             'jumlah_kk' => 'required|integer|min:0',
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
