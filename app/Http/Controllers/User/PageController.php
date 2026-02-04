<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Bpd;
use App\Models\DetailRekapitulasi;
use App\Models\KarangTaruna;
use App\Models\PerangkatDesa;
use App\Models\Pkk;
use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function welcome()
    {
        $beritas = DB::table('beritas')
            ->select(
                'users.username',
                'beritas.judul_berita',
                'beritas.isi_berita',
                'beritas.url_gambar',
                'beritas.slug',
                'beritas.created_at',
            )
            ->leftJoin('users', 'beritas.id_users', '=', 'users.id')
            ->orderBy('beritas.created_at', 'desc')
            ->limit(3)
            ->get();

        return view('welcome', compact('beritas'));
    }

    public function ketuaRT()
    {
        $rt = RT::select(
            'nomor_rt',
            'nama_rt'
        )->where('is_active', '=', 1)->get();

        // dd($rt);

        return view('ketuart', [
            'datas' => $rt
        ]);


    }
    public function pendudukIndex()
    {
        $pendudukDetail = DetailRekapitulasi::select(
            'kelompok_umur',
            'jumlah_laki_laki_akhir',
            'jumlah_perempuan_akhir',
            'jumlah_kk',
            DB::raw('(jumlah_laki_laki_akhir + jumlah_perempuan_akhir) as total_akhir'),
            DB::raw('(jumlah_laki_laki_datang + jumlah_perempuan_datang) as total_datang'),
            DB::raw('(jumlah_laki_laki_pindah + jumlah_perempuan_pindah) as total_pindah'),
        )->get();
        $summary = [
            'totalPenduduk' => $pendudukDetail->sum('total_akhir'),
            'totalLaki' => $pendudukDetail->sum('jumlah_laki_laki_akhir'),
            'totalPerempuan' => $pendudukDetail->sum('jumlah_perempuan_akhir'),
            'jumlah_kk' => $pendudukDetail->sum('jumlah_kk'),
        ];

        // dd($summary);
        return view('datapenduduk', [
            'penduduk' => array_map('number_format', $summary),
            //  'dataRt' => RT::all(),
        ]);
    }

    public function beritaIndex()
    {
        $berita = DB::table('beritas')
            ->select(
                'users.username',
                'beritas.judul_berita',
                'beritas.isi_berita',
                'beritas.url_gambar',
                'beritas.slug',
                'beritas.created_at',
            )
            ->leftJoin('users', 'beritas.id_users', '=', 'users.id')
            ->orderBy('beritas.created_at', 'desc')
            ->paginate(10);

        // $berita = Berita::all();
        // dd($berita);
        return view('berita', [
            'berita' => $berita,
        ]);
    }

    public function loadMoreBerita(Request $request)
    {
        $page = $request->get('page', 2);

        $berita = DB::table('beritas')
            ->select(
                'users.username',
                'beritas.judul_berita',
                'beritas.isi_berita',
                'beritas.url_gambar',
                'beritas.slug',
                'beritas.created_at',
            )
            ->leftJoin('users', 'beritas.id_users', '=', 'users.id')
            ->orderBy('beritas.created_at', 'desc')
            ->paginate(6, ['*'], 'page', $page);

        if ($berita->count() > 0) {
            $html = '';
            foreach ($berita as $item) {
                $html .= '
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <a href="' . route('berita.detail', $item->slug) . '">
                        <img src="' . asset('storage/' . $item->url_gambar) . '" alt="' . $item->judul_berita . '"
                            class="w-full h-52 object-cover" >
                        <div class="p-4 px-8">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2">
                                    <img src="' . asset('images/icon/date.svg') . '" alt="Tanggal" class="w-4 h-4 text-gray-500">
                                    <p class="text-xs text-gray-500">' . \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') . '</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <img src="' . asset('images/icon/person.svg') . '" alt="Penulis" class="w-4 text-gray-500">
                                    <span class="text-xs text-gray-500">' . $item->username . '</span>
                                </div>
                            </div>
                            <h2 class="text-xl font-bold mt-2">' . $item->judul_berita . '</h2>
                            <div class="text-gray-600 mb-4 line-clamp-3 text-sm mt-2">
                                ' . Str::limit(strip_tags($item->isi_berita), 150) . '
                            </div>
                        </div>
                    </a>
                </div>';
            }

            return response()->json([
                'html' => $html,
                'hasMore' => $berita->hasMorePages(),
            ]);
        }

        return response()->json([
            'html' => '',
            'hasMore' => false,
        ]);
    }

    public function beritaDetail($slug)
    {
        $berita = DB::table('beritas')
            ->select(
                'users.username',
                'users.name as nama_lengkap',
                'beritas.judul_berita',
                'beritas.isi_berita',
                'beritas.url_gambar',
                'beritas.slug',
                'beritas.created_at',
            )
            ->leftJoin('users', 'beritas.id_users', '=', 'users.id')
            ->where('beritas.slug', $slug)
            ->first();

        if (!$berita) {
            abort(404);
        }

        return view('detailBerita', [
            'berita' => $berita,
        ]);
    }

    public function relatedNews($slug)
    {
        $related = DB::table('beritas')
            ->select(
                'users.username',
                'beritas.judul_berita',
                'beritas.isi_berita',
                'beritas.url_gambar',
                'beritas.slug',
                'beritas.created_at',
            )
            ->leftJoin('users', 'beritas.id_users', '=', 'users.id')
            ->where('beritas.slug', '!=', $slug)
            ->orderBy('beritas.created_at', 'desc')
            ->limit(3)
            ->get();

        $html = '';
        foreach ($related as $item) {
            $html .= '
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition duration-200">
                <a href="' . route('berita.detail', $item->slug) . '">
                    <img src="' . asset('storage/' . $item->url_gambar) . '" alt="' . $item->judul_berita . '"
                        class="w-full h-48 object-cover" >
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-xs text-gray-500">' . \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') . '</span>
                            <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">Berita</span>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2 line-clamp-2">' . $item->judul_berita . '</h3>
                        <p class="text-gray-600 text-sm line-clamp-2">' . Str::limit(strip_tags($item->isi_berita), 100) . '</p>
                    </div>
                </a>
            </div>';
        }

        return response()->json(['html' => $html]);
    }

    public function karangTaruna()
    {

        return view('karangtaruna', [
            'datas' => KarangTaruna::select(
                'nama_anggota',
                'jabatan'
            )->get(),
        ]);
    }

    public function Bpd()
    {

        return view('badanpermusyawaratandesa', [
            'datas' => Bpd::select(
                'nama_bpd',
                'jabatan_bpd'
            )->get(),
        ]);

    }

    public function Ibupkk()
    {
        $datas_pokja = Pkk::select(
            'nama_pkk',
            'jabatan_pkk',
            'kelompok_kerja'
        )
            ->where('kelompok_kerja', '!=', 'pengurus inti')
            ->orderBy('kelompok_kerja')
            ->get();
        $pokja_grouped = $datas_pokja->groupBy('kelompok_kerja');

        // Menghitung jumlah baris maksimum di semua Pokja
        $max_rows = $pokja_grouped->max(function ($pokja) {
            return $pokja->count();
        }) ?? 0; // Default ke 0 jika tidak ada data

        return view('ibupkk', [
            'datas_inti' => Pkk::select(
                'nama_pkk',
                'jabatan_pkk',
                'kelompok_kerja'
            )->where('kelompok_kerja', 'pengurus inti')->get(),
            'datas_pokja' => $pokja_grouped,
            'max_rows' => $max_rows,

        ]);

    }

    public function PerangkatDesa()
    {

        return view('strukturorganisasi', [
            'datas' => PerangkatDesa::select(
                'nama_pd',
                'jabatan_pd',
                'pendidikan_pd',
                'tempat_tanggal_lahir_pd',
                'agama_pd',
                'alamat_pd',
                'url_foto_profil'

            )->get()
        ]);
    }
}

