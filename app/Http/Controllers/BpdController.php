<?php

namespace App\Http\Controllers;

use App\Models\Bpd;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Bpd',[
            'datas' => Bpd::all()
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
        // dd($request);
        $request->validate([
            'nama_bpd' => 'required|string|min:3|max:200',
            'jabatan_bpd' => 'required|string|max:200'
        ]);

        Bpd::create([
            'id_bpd' => bin2hex(random_bytes(4)).time(),
            'nama_bpd' => $request->nama_bpd,
            'jabatan_bpd' => $request->jabatan_bpd
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Bpd $bpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bpd $bpd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request,$id);
         $request->validate([
            'nama_bpd' => 'required|string|min:3|max:200',
            'jabatan_bpd' => 'required|string|max:200'
        ]);

        $bpd = Bpd::findOrFail($id);
        $bpd->update([
            'nama_bpd' => $request->nama_bpd,
            'jabatan_bpd' => $request->jabatan_bpd
        ]);

        return redirect()->back()->with('success', 'data berhasil diperbarui!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bpd = Bpd::findOrFail($id);

        $bpd->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');

    }
}
