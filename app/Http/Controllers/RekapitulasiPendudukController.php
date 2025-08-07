<?php

namespace App\Http\Controllers;

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
            'datas' => RekapitulasiPenduduk::all(),
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
    public function update(Request $request, RekapitulasiPenduduk $rekapitulasiPenduduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekapitulasiPenduduk $rekapitulasiPenduduk)
    {
        //
    }
}
