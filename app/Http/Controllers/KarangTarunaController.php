<?php

namespace App\Http\Controllers;

use App\Models\KarangTaruna;
use Illuminate\Http\Request;
use Inertia\Inertia;


class KarangTarunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('KarangTaruna', [
            'datas' => KarangTaruna::all()
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
        $validated = $request->validate([
            'nama_anggota' => "required|string|min:3",
            "jabatan" => "required|string|max:100"
        ]);
        $validated['id_karangtaruna'] = "krtn".time().bin2hex(random_bytes(4));

        // dd($validated);
        KarangTaruna::create($validated);

        return redirect()->back()->with('success', 'berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(KarangTaruna $karangTaruna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KarangTaruna $karangTaruna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_karangtaruna)
    {
        $data = KarangTaruna::findOrFail($id_karangtaruna);
        $validated = $request->validate([
            'nama_anggota' => "required|string|min:3",
            "jabatan" => "required|string|max:100"
        ]);
        // dd($validated);
        $data->update($validated);

        return redirect()->back()->with('success', 'berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id_karangtaruna)
    {
        $data = KarangTaruna::where('id_karangtaruna', $id_karangtaruna)->firstOrFail();
        $data->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
