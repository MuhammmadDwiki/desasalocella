<?php

namespace App\Http\Controllers;

use App\Models\KelompokKerja;
use App\Models\Pkk;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class KelompokKerjaController extends Controller
{
    public function index()
    {
        $kelompokKerjas = KelompokKerja::withCount('pkks')->orderBy('nama_kelompok_kerja')->get();
        return Inertia::render('KelompokKerja', [
            'kelompokKerjas' => $kelompokKerjas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok_kerja' => 'required|string|max:255|unique:kelompok_kerjas,nama_kelompok_kerja',
        ], [
            'nama_kelompok_kerja.required' => 'Nama kelompok kerja wajib diisi',
            'nama_kelompok_kerja.unique' => 'Nama kelompok kerja sudah ada',
        ]);

        KelompokKerja::create([
            'nama_kelompok_kerja' => $request->nama_kelompok_kerja,
        ]);

        return redirect()->back()->with('success', 'Kelompok kerja berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kelompokKerja = KelompokKerja::findOrFail($id);
        
        $request->validate([
            'nama_kelompok_kerja' => 'required|string|max:255|unique:kelompok_kerjas,nama_kelompok_kerja,' . $id . ',id_kelompok_kerja',
        ], [
            'nama_kelompok_kerja.required' => 'Nama kelompok kerja wajib diisi',
            'nama_kelompok_kerja.unique' => 'Nama kelompok kerja sudah ada',
        ]);

        // Simpan nama lama untuk update referensi di tabel pkks
        $namaLama = $kelompokKerja->nama_kelompok_kerja;
        $namaBaru = $request->nama_kelompok_kerja;

        DB::beginTransaction();
        try {
            // Update kelompok kerja
            $kelompokKerja->update([
                'nama_kelompok_kerja' => $namaBaru,
            ]);

            // Update semua referensi kelompok kerja di tabel pkks
            Pkk::where('kelompok_kerja', $namaLama)->update([
                'kelompok_kerja' => $namaBaru
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Kelompok kerja berhasil diupdate dan semua data PKK terkait telah diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal mengupdate kelompok kerja: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $kelompokKerja = KelompokKerja::findOrFail($id);
        
        // Cek apakah ada data PKK yang masih menggunakan kelompok kerja ini
        $jumlahPkk = Pkk::where('kelompok_kerja', $kelompokKerja->nama_kelompok_kerja)->count();
        
        if ($jumlahPkk > 0) {
            return redirect()->back()->withErrors([
                'error' => "Tidak dapat menghapus kelompok kerja '{$kelompokKerja->nama_kelompok_kerja}' karena masih ada {$jumlahPkk} anggota PKK yang terdaftar. Silakan pindahkan atau hapus anggota PKK tersebut terlebih dahulu."
            ]);
        }

        $kelompokKerja->delete();
        return redirect()->back()->with('success', 'Kelompok kerja berhasil dihapus');
    }

    // Method tambahan untuk memindahkan anggota PKK ke kelompok kerja lain sebelum dihapus
    public function deleteWithTransfer(Request $request, $id)
    {
        $request->validate([
            'kelompok_kerja_baru' => 'nullable|string|max:255',
        ]);

        $kelompokKerja = KelompokKerja::findOrFail($id);
        $kelompokKerjaBaru = $request->kelompok_kerja_baru; // Bisa null jika dipindahkan ke Pengurus Inti

        DB::beginTransaction();
        try {
            // Pindahkan semua anggota PKK ke kelompok kerja baru atau jadikan Pengurus Inti
            Pkk::where('kelompok_kerja', $kelompokKerja->nama_kelompok_kerja)->update([
                'kelompok_kerja' => $kelompokKerjaBaru
            ]);

            // Hapus kelompok kerja
            $kelompokKerja->delete();

            DB::commit();
            
            if ($kelompokKerjaBaru) {
                return redirect()->back()->with('success', "Kelompok kerja berhasil dihapus dan semua anggota dipindahkan ke {$kelompokKerjaBaru}");
            } else {
                return redirect()->back()->with('success', 'Kelompok kerja berhasil dihapus dan semua anggota dipindahkan ke Pengurus Inti');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus kelompok kerja: ' . $e->getMessage()]);
        }
    }
}