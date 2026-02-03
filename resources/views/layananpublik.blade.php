@extends('layouts.app')

@section('title', 'Layanan Publik - Desa Sallo Cela')

@section('content')
<div class="">

    <section class="mt-28 px-5">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Layanan Administrasi Desa</h2>
    </section>

    <div class="px-5 pb-8 max-w-5xl mx-auto space-y-8">

        {{-- Kutipan Akta Kelahiran --}}
        <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-right">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Kutipan Akta Kelahiran</h2>

            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pencatatan Lahir Baru (0–60 hari)</h3>
            <ul class="list-disc pl-6 space-y-1 text-gray-700 mb-4">
                <li>Surat keterangan kelahiran dari kelurahan/desa</li>
                <li>Surat keterangan dari dokter/bidan/penolong kelahiran</li>
                <li>Fotokopi surat nikah/akta perkawinan (legalisir)</li>
                <li>Fotokopi KK orang tua (nama anak sudah tercantum)</li>
                <li>Fotokopi KTP orang tua (Ayah dan Ibu)</li>
                <li>Fotokopi KTP 2 orang saksi</li>
                <li>Surat kuasa bermaterai Rp 6.000 jika dikuasakan</li>
            </ul>

            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pencatatan Lahir Terlambat (>60 hari)</h3>
            <ul class="list-disc pl-6 space-y-1 text-gray-700">
                <li>Surat keterangan kelahiran dari kelurahan/desa atau tenaga medis</li>
                <li>Fotokopi surat nikah/akta perkawinan (legalisir)</li>
                <li>Fotokopi KK orang tua</li>
                <li>Fotokopi KTP orang tua</li>
                <li>Fotokopi KTP 2 orang saksi</li>
                <li>Surat kuasa bermaterai Rp 6.000 jika dikuasakan</li>
                <li>Keputusan dari Kepala Dinas Dukcapil</li>
            </ul>
        </div>

        {{-- Akta Kematian --}}
        <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-left">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Akta Kematian</h2>
            <ul class="list-disc pl-6 space-y-1 text-gray-700">
                <li>Surat keterangan kematian dari RS/Puskesmas/Kepala Desa</li>
                <li>Fotokopi KK dan KTP</li>
                <li>Kutipan Akta Kelahiran (jika ada)</li>
                <li>Fotokopi KTP 2 orang saksi (usia ≥21 tahun)</li>
                <li>Bagi WNI keturunan: Surat bukti kewarganegaraan RI</li>
                <li>Bagi WNA: Fotokopi Passport dan dokumen imigrasi</li>
            </ul>
        </div>

        {{-- Kartu Keluarga --}}
        <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-right">
            <h2 class="text-2xl font-bold text-red-600 mb-4">Kartu Keluarga (KK)</h2>

            <h3 class="text-lg font-semibold text-gray-800 mb-2">Penerbitan KK Baru</h3>
            <ul class="list-disc pl-6 space-y-1 text-gray-700 mb-4">
                <li>Pengantar dari RT/RW dan desa</li>
                <li>Keterangan Ijin Tinggal Tetap (WNA)</li>
                <li>Surat keterangan pindah</li>
                <li>Fotokopi akta kelahiran dan ijazah</li>
                <li>Fotokopi akta nikah</li>
            </ul>

            <h3 class="text-lg font-semibold text-gray-800 mb-2">Perubahan Data KK</h3>
            <ul class="list-disc pl-6 space-y-1 text-gray-700">
                <li>Pengantar dari RT/RW dan desa</li>
                <li>KK lama</li>
                <li>Dokumen pendukung perubahan</li>
            </ul>
        </div>

    </div>
</div>

@endsection