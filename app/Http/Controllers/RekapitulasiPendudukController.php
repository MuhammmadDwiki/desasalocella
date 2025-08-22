<?php

namespace App\Http\Controllers;

use App\Models\DetailRekapitulasi;
use App\Models\RT;
use App\Models\RekapitulasiPenduduk;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\RekapitulasiRT;



class RekapitulasiPendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();

            // Query dasar untuk rekapitulasi
            $query = RekapitulasiPenduduk::query();
            // dd($query);
            $datas = $query->orderBy('tahun', 'desc')
                ->orderByRaw(" CASE 
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
                END")
                ->get();

            return Inertia::render('LaporanBulanan', [
                'datas' => $datas
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengambil data laporan bulanan: ' . $e->getMessage()]);
        }
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
        try {

            $validated = $request->validate([
                'bulan' => 'required|string|max:255',
                'tahun' => 'required|string|regex:/^[0-9]{4}$/|integer|min:2000|max:2100',
            ]);


            // Cek apakah sudah ada rekapitulasi untuk bulan dan tahun yang sama
            $exists = RekapitulasiPenduduk::where('bulan', $validated['bulan'])
                                        ->where('tahun', $validated['tahun'])
                                        ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'bulan' => ['Laporan untuk bulan dan tahun ini sudah ada.'],
                ]);
            }

            DB::beginTransaction();

            // Generate ID unik untuk rekapitulasi
            $id_rekap = 'RKP-' . $validated['tahun'] . $validated['bulan'] . '-' . strtoupper(Str::random(6));

            $rekapitulasi = RekapitulasiPenduduk::create([
                'id_rekap' => $id_rekap,
                'bulan' => $validated['bulan'],
                'tahun' => $validated['tahun'],
            ]);

            DB::commit();

            return redirect()->route('laporan.index')
                           ->with('success', 'Laporan bulanan berhasil ditambahkan');

        } catch (ValidationException $e) {
            DB::rollback();
            throw $e;
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Gagal menambahkan laporan: ' . $e->getMessage()]);
        }
    }

     /**
     * Display the specified resource.
     */
    public function show(string $id_rekap)
    {
        try {
            $user = Auth::user();
            // dd($id_rekap);
            // Ambil data rekapitulasi
            $rekapitulasi = RekapitulasiPenduduk::where('id_rekap', $id_rekap)->first();
            
            if (!$rekapitulasi) {
                return back()->withErrors(['error' => 'Laporan tidak ditemukan']);
            }
    // Query rekapitulasi RT dengan relasi
            $query = RekapitulasiRT::with(['rt', 'submittedBy'])
                ->where('id_rekap', $id_rekap);

            // Filter berdasarkan role user
            if ($user->role === 'moderator') {
                $query->where('id_rt', $user->id_rt);
            }

            $rekapRTs = $query->get();

        // Transform data untuk frontend
        $datas = $rekapRTs->map(function ($item) {
            return [
                'id_rekap_rt' => $item->id_rekap_rt,
                'id_rt' => $item->id_rt,
                'nomor_rt' => $item->rt?->nomor_rt ?? '',
                'nama_rt' => $item->rt?->nama_rt ?? '',
                'jumlah_kk' => $item->jumlah_kk,
                'jumlah_penduduk_akhir' => $item->jumlah_penduduk_akhir,
                'status' => $item->status,
                'catatan_validasi' => $item->catatan_validasi,
                'submitted_at' => $item->submitted_at?->format('Y-m-d H:i'),
                'validated_at' => $item->validated_at?->format('Y-m-d H:i'),
                'submitted_by' => $item->submittedBy?->name,
                // 'validated_by' => $item->validatedBy?->name,
            ];
        });

        // Ambil daftar RT untuk dropdown (filter untuk moderator)
        $rtQuery = RT::where('is_active', true);
        if ($user->role === 'moderator') {
            $rtQuery->where('id_rt', $user->id_rt);
        }
        $rtList = $rtQuery->get();

        return Inertia::render('DetailLaporanBulanan', [
            'id' => $id_rekap,
            'datas' => $datas,
            'rtList' => $rtList,
            'laporanInfo' => [
                'id_rekap' => $rekapitulasi->id_rekap,
                'bulan' => $rekapitulasi->bulan,
                'tahun' => $rekapitulasi->tahun,
            ],
        ]);


        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => 'Gagal mengambil detail laporan: ' . $e->getMessage()]);
        }
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
    public function update(Request $request, string $id_rekap)
    {
        try {
            $validated = $request->validate([
                'bulan' => 'required|string|max:255',
                'tahun' => 'required|string|regex:/^[0-9]{4}$/|integer|min:2000|max:2100',
            ]);

            $rekapitulasi = RekapitulasiPenduduk::where('id_rekap', $id_rekap)->first();

            if (!$rekapitulasi) {
                return back()->withErrors(['error' => 'Laporan tidak ditemukan']);
            }

            // Cek apakah sudah ada rekapitulasi lain untuk bulan dan tahun yang sama
            $exists = RekapitulasiPenduduk::where('bulan', $validated['bulan'])
                                        ->where('tahun', $validated['tahun'])
                                        ->where('id_rekap', '!=', $id_rekap)
                                        ->exists();

            if ($exists) {
                throw ValidationException::withMessages([
                    'bulan' => ['Laporan untuk bulan dan tahun ini sudah ada.'],
                ]);
            }

            DB::beginTransaction();

            $rekapitulasi->update([
                'bulan' => $validated['bulan'],
                'tahun' => $validated['tahun'],
            ]);

            DB::commit();

            return redirect()->route('laporan.index')
                           ->with('success', 'Laporan bulanan berhasil diupdate');

        } catch (ValidationException $e) {
            DB::rollback();
            throw $e;
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Gagal mengupdate laporan: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_rekap)
    {
        try {
            $user = Auth::user();
            
            $rekapitulasi = RekapitulasiPenduduk::where('id_rekap', $id_rekap)->first();

            if (!$rekapitulasi) {
                return back()->withErrors(['error' => 'Laporan tidak ditemukan']);
            }

            // Cek authorization - hanya super_admin yang bisa hapus rekapitulasi
            if ($user->role !== 'super_admin') {
                return back()->withErrors(['error' => 'Anda tidak memiliki akses untuk menghapus laporan ini']);
            }

            DB::beginTransaction();

            // Hapus semua detail rekapitulasi terlebih dahulu
            DetailRekapitulasi::where('id_rekap', $id_rekap)->delete();

            // Hapus rekapitulasi
            $rekapitulasi->delete();

            DB::commit();

            return redirect()->route('laporan.index')
                           ->with('success', 'Laporan bulanan dan semua detailnya berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Gagal menghapus laporan: ' . $e->getMessage()]);
        }
    }

    /**
     * Get monthly report statistics
     */
    public function getStatistics(string $id_rekap)
    {
        try {
            $stats = DetailRekapitulasi::where('id_rekap', $id_rekap)
                                     ->selectRaw('
                                         COUNT(DISTINCT id_rt) as total_rt,
                                         SUM(jumlah_kk) as total_kk,
                                         SUM(jumlah_laki_laki_awal + jumlah_perempuan_awal) as total_penduduk_awal,
                                         SUM(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total_penduduk_akhir,
                                         SUM(jumlah_laki_laki_pindah + jumlah_perempuan_pindah) as total_pindah,
                                         SUM(jumlah_laki_laki_datang + jumlah_perempuan_datang) as total_datang
                                     ')
                                     ->first();

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik: ' . $e->getMessage()
            ], 500);
        }
    }
}
