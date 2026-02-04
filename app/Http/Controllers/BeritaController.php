<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();

        return Inertia::render('Berita', [
            'datas' => $beritas,
        ]);
    }
    //TODO: buat optimasi compress file gambar yang di simpan, perkecil ukuran

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }
        // $validated['id_berita'] = bin2hex(random_bytes(4)) . time();

        Berita::create([
            'id_berita' => bin2hex(random_bytes(4)) . time(),
            'judul_berita' => $request->judul,
            'isi_berita' => $request->isi,
            'url_gambar' => $gambarPath,
            'slug' => Str::slug($request->judul) . '-' . time(),
            'id_users' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20048',
            'existing_gambar' => 'nullable|string',
            'remove_gambar' => 'nullable|string',
        ]);

        $berita = Berita::findOrFail($id);

        $gambarPath = $berita->gambar;

        // Handle penghapusan gambar
        if ($request->has('remove_gambar') && $request->remove_gambar === 'true') {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = null;
        }
        // Handle upload gambar baru
        elseif ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }
        // Gunakan existing gambar jika tidak ada file baru dan tidak dihapus
        elseif ($request->has('existing_gambar') && $request->existing_gambar) {
            $gambarPath = $request->existing_gambar;
        }

        $berita->update([
            'judul_berita' => $request->judul,
            'isi_berita' => $request->isi,
            'url_gambar' => $gambarPath,
            'slug' => Str::slug($request->judul),
        ]);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->back()->with('success', 'Berita berhasil dihapus!');
    }
}
