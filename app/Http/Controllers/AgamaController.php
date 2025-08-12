<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use Inertia\Inertia;


class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Agama', [
            'datas' => Agama::all()
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
            'nama_agama' => "required|string|unique:agamas,nama_agama",
            "jumlah_penduduk" => "required|regex:/^\d+$/"
        ], [
            'nama_agama.required'      => 'Nama agama wajib diisi.',
            'nama_agama.string'        => 'Nama agama harus berupa teks.',
            'jumlah_penduduk.integer'  => 'Jumlah penduduk harus berupa angka bulat.',
            'jumlah_penduduk.required' => 'Jumlah penduduk wajib diisi.',
            'jumlah_penduduk.regex'    => 'Jumlah penduduk harus berupa angka bulat.'
        ]);
       
        $validated['id_agama'] = bin2hex(random_bytes(4)) . time();

        Agama::create($validated);
        return redirect()->back()->with('success', 'Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agama $agama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agama $agama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_agama)
    {
        $agama = Agama::findOrFail($id_agama);

        $validated = $request->validate([
            'nama_agama'      => 'required|string',
            'jumlah_penduduk' => ['required', 'regex:/^\d+$/']
        ], [
            'nama_agama.required'      => 'Nama agama wajib diisi.',
            'nama_agama.string'        => 'Nama agama harus berupa teks.',
            'jumlah_penduduk.required' => 'Jumlah penduduk wajib diisi.',
            'jumlah_penduduk.regex'    => 'Jumlah penduduk harus berupa angka bulat.'
        ]);

        $agama->update($validated);

        return redirect()->back()->with('success', 'Data agama berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_agama)
    {
        $agama = Agama::where('id_agama', $id_agama)->firstOrFail();
        $agama->delete();

        return redirect()->back()->with('success', 'Data Agama berhasil dihapus');
    }
}
