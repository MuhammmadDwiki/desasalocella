<?php

namespace App\Http\Controllers;

use App\Models\RT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;



class RTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RT::all()->map(function ($rt) {
            return [
                'id_rt' => $rt->id_rt,
                'nomor_rt' => $rt->nomor_rt, // Force string
                'nama_rt' => $rt->nama_rt,
                'alamat_rt' => $rt->alamat_rt,
                'nomor_hp' => $rt->nomor_hp,
                'is_active' => (bool)$rt->is_active // Force boolean
            ];
        });
        $data2 = RT::all();
        // dd($data2);
        return Inertia::render('KelolaRT', ['datas' => $data2]);
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
        // echo `<script> console.log($request)</script>`;
        $validated = $request->validate([
            'nomor_rt' => 'required|string|max:10|regex:/^[0-9]+$/|unique:r_t_s,nomor_rt',
            'nama_rt' => 'required|string|max:100',
            'alamat_rt' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15|regex:/^\+?[0-9]+$/',
            'is_active' => 'boolean',
        ]);
        $validated['alamat_rt'] = $validated['alamat_rt'] ?? '-';
        $validated['nomor_hp'] = $validated['nomor_hp'] ?? '-';
        $validated['id_rt'] = 'RT-' . bin2hex(random_bytes(8));


        RT::create($validated);

        return redirect()->back()->with('success', 'Data RT berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(RT $rT)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RT $rT)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_rt)
    {
        $rt = RT::findOrFail($id_rt);

        // dd($request);
        $validated = $request->validate([
            'nomor_rt' => [
                'required',
                'string',
                'max:10',
                function ($attribute, $value, $fail) use ($rt) {
                    // Jika nomor_rt diubah dan sudah ada di database (selain record ini)
                    if (
                        $value != $rt->nomor_rt && RT::where('nomor_rt', $value)
                        ->where('id_rt', '!=', $rt->id_rt)
                        ->exists()
                    ) {
                        $fail('Nomor RT sudah digunakan.');
                    }
                }
            ],
            'nama_rt' => 'required|string|max:100',
            'alamat_rt' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15',
            'is_active' => 'boolean',
        ]);
        $validated['alamat_rt'] = $validated['alamat_rt'] ?? '-';
        $validated['nomor_hp'] = $validated['nomor_hp'] ?? '-';

        $rt->update($validated);

        return redirect()->back()->with('success', 'Data RT berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_rt)
    {
        $rt = RT::findOrFail($id_rt);

        $rt->delete();

        return redirect()->back()->with('success', 'Data RT berhasil dihapus');
    }
}
