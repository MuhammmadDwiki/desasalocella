<?php

namespace App\Http\Controllers;

use App\Models\RekapitulasiRT;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class RekapitulasiRTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        dd(Auth::user());
        $validated = $request->validate([
        'id_rekap' => 'required|exists:rekapitulasi_penduduks,id_rekap',
        'id_rt' => 'required|exists:r_t_s,id_rt|unique:rekapitulasi_r_t_s,id_rt,NULL,id,id_rekap,'.$request->id_rekap,
        'jumlah_kk' => 'required|integer|min:0',
        'jumlah_penduduk_akhir' => 'required|integer|min:0',
        ]);

        RekapitulasiRT::create([
            'id_rekap_rt' => 'RRT-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
            'id_rekap' => $validated['id_rekap'],
            'id_rt' => $validated['id_rt'],
            'jumlah_kk' => $validated['jumlah_kk'],
            'jumlah_penduduk_akhir' => $validated['jumlah_penduduk_akhir'],
            'submitted_by' => Auth::user(),
            'status' => 'draft',
        ]);

        return back()->with('success', 'Data RT berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(RekapitulasiRT $rekapitulasiRT)
    {
        //
    }
    public function submit($id_rekap_rt)
    {
        $rekap = RekapitulasiRT::findOrFail($id_rekap_rt);
        // Authorization check
        if (Auth::check() && Auth::user()->role === 'moderator') {
            if (!$rekap->where('id_rt', Auth::user()->id_rt)->first()) {
                abort(403, 'Unauthorized');
            }
        }

        $rekap->update([
            'status' => 'pending',
            'submitted_at' => now()
        
        ]);

        return redirect()->back()->with('success', 'Laporan diajukan untuk verifikasi');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RekapitulasiRT $rekapitulasiRT)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RekapitulasiRT $rekapitulasiRT)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekapitulasiRT $rekapitulasiRT)
    {
        //
    }
}
