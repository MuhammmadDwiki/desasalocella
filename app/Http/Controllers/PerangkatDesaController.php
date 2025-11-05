<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PerangkatDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PerangkatDesa::all();

        return Inertia::render('PerangkatDesa', [
            'datas' => $data
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_pd' => "required|string|min:3",
            'jabatan_pd' => "required|string|max:50",
            'pendidikan_pd' => "required|string|max:50",
            'tempat_tanggal_lahir_pd' => "required|string|max:150",
            'agama_pd' => "required|string|max:50",
            'alamat_pd' => "required|string|max:250",
            'url_foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048', //max 20Mb

        ]);

        $gambarPath = null;
        if ($request->hasFile('url_foto_profil')) {
            $gambarPath = $request->file('url_foto_profil')->store('perangkatDesa', 'public');
        }

        PerangkatDesa::create([
            'id_prDesa' => bin2hex(random_bytes(4)).time(),
            'nama_pd' => $request->nama_pd,
            'jabatan_pd' => $request->jabatan_pd,
            'pendidikan_pd' => $request->pendidikan_pd,
            'tempat_tanggal_lahir_pd' => $request->tempat_tanggal_lahir_pd,
            'agama_pd' => $request->agama_pd,
            'alamat_pd' => $request->alamat_pd,
            'url_foto_profil' => $gambarPath,

        ]); 

        return redirect()->back()->with('success', 'perangkat desa berhasil ditambahkan!');



    }

    /**
     * Display the specified resource.
     */
    public function show(PerangkatDesa $perangkatDesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PerangkatDesa $perangkatDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PerangkatDesa $perangkatDesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerangkatDesa $perangkatDesa)
    {
        //
    }
}
