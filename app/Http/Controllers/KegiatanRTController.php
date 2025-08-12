<?php

namespace App\Http\Controllers;

use App\Models\KegiatanRT;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KegiatanRTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Kegiatan', [
            'datas' => KegiatanRT::all()
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
        $validated = $request->validate(
            [
                'nama_kegiatan' => 'required|string|max:255',
                'tanggal_kegiatan' => 'required|string',
                'lokasi_kegiatan' => 'required|string',
                'keterangan' => 'nullable|string|max:255'
            ]
        );
        $validated['keterangan'] ??= '-';
        $validated['id_kegiatan'] = 'KG'.time(). bin2hex(random_bytes(4));
        
        KegiatanRT::create($validated);

        return redirect()->back()->with('success','berhasil menambahkan kegiatan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KegiatanRT $kegiatanRT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KegiatanRT $kegiatanRT)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kegiatan)
    {
        $kegiatan = KegiatanRT::findOrFail($id_kegiatan);

        $validated = $request->validate(
            [
                'nama_kegiatan' => 'required|string|max:255',
                'tanggal_kegiatan' => 'required|string',
                'lokasi_kegiatan' => 'required|string',
                'keterangan' => 'nullable|string|max:255'
            ]
        );

        $kegiatan->update($validated);

        return redirect()->back()->with('success','berhasil update');

    }

    /**
     * Remove the specified resource from storage.
     */
      public function destroy($id_kegiatan)
    {
        $kegiatan = KegiatanRT::where('id_kegiatan', $id_kegiatan)->firstOrFail();
        $kegiatan->delete();

        return redirect()->back()->with('success', 'Data kegiatan berhasil dihapus');
    }
}
