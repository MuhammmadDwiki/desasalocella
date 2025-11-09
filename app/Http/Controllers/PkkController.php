<?php

namespace App\Http\Controllers;

use App\Models\Pkk;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\KelompokKerja;
class PkkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pkks = Pkk::orderBy('created_at', 'desc')->get();
        $kelompokKerjas = KelompokKerja::orderBy('nama_kelompok_kerja')->get();
        
        return Inertia::render('Pkk', [
            'datas' => $pkks,
            'kelompokKerjas' => $kelompokKerjas
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
       $request->validate([
            'nama_pkk' => 'required|string|max:255',
            'jabatan_pkk' => 'required|string|max:255',
            'kelompok_kerja' => 'required|string|max:255',
        ], [
            'nama_pkk.required' => 'Nama anggota wajib diisi',
            'jabatan_pkk.required' => 'Jabatan wajib diisi',
        ]);

        Pkk::create([
            'id_pkk' =>  bin2hex(random_bytes(4)).time(),
            'nama_pkk' => $request->nama_pkk,
            'jabatan_pkk' => $request->jabatan_pkk,
            'kelompok_kerja' => $request->kelompok_kerja,
        ]);

        return redirect()->back()->with('success', 'Data PKK berhasil ditambahkan');
    }

     public function update(Request $request, $id)
    {
        $pkk = Pkk::findOrFail($id);
        
        $request->validate([
            'nama_pkk' => 'required|string|max:255',
            'jabatan_pkk' => 'required|string|max:255',
            'kelompok_kerja' => 'nullable|string|max:255',
        ]);

        $pkk->update([
            'nama_pkk' => $request->nama_pkk,
            'jabatan_pkk' => $request->jabatan_pkk,
            'kelompok_kerja' => $request->kelompok_kerja,
        ]);

        return redirect()->back()->with('success', 'Data PKK berhasil diupdate');
    }
    public function destroy($id)
    {
        $pkk = Pkk::findOrFail($id);
        $pkk->delete();

        return redirect()->back()->with('success', 'Data PKK berhasil dihapus');
    }
}
