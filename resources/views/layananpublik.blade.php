<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Layanan Desa Sallo Cela</title>
<link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
</head>
<body>

<header>
    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="logo">
    <div>
        <div class="title">Desa Sallo Cela</div>
        <div class="subtitle">
            Kec. Muara Badak, Kab. Kutai Kartanegara,<br>
            Prov. Kalimantan Timur
        </div>
    </div>
</header>

<nav>
    <div><a href="{{route('userWelcome')}}">🏠</a></div>

    <div class="has-dropdown">
        <a href="#">Profil Desa ▼</a>
        <div class="dropdown">
            <a href="{{route('sejarah')}}">Sejarah Desa</a>
            <a href="{{route('visi')}}">Visi & Misi</a>
            <a href="{{route('struk')}}">Struktur Organisasi</a>
        </div>
    </div>

    <div class="has-dropdown">
        <a href="#">Data Desa ▼</a>
        <div class="dropdown">
            <a href="{{route('dapen')}}">Data Penduduk</a>
            <a href="{{route('anggaran')}}">Anggaran Desa</a>
        </div>
    </div>

    <div class="has-dropdown">
        <a href="#">Kelembagaan ▼</a>
        <div class="dropdown">
            <a href="{{route('bpd')}}">BPD</a>
            <a href="{{route('karangtrn')}}">Karang Taruna</a>
            <a href="{{route('ketua')}}">Ketua RT</a>
            <a href="{{route('linmass')}}">Linmas</a>
            <a href="{{route('posy')}}">Posyandu</a>
            <a href="{{route('pkk')}}">PKK</a>
        </div>
    </div>

    <div><a href="{{route('potensi')}}">Potensi Desa</a></div>
    <div><a href="{{route('layanan')}}">Layanan</a></div>

    <div><span class="search-icon" onclick="showSearch()">🔍</span></div>
</nav>

<main>
    <h1>Layanan Administrasi Kependudukan</h1>

    <section>
        <h2>Kutipan Akta Kelahiran</h2>
        <h3>Pencatatan Lahir Baru (0–60 hari)</h3>
        <ul>
            <li>Surat keterangan kelahiran dari kelurahan/desa</li>
            <li>Surat keterangan dari dokter/bidan/penolong kelahiran</li>
            <li>Fotokopi surat nikah/akta perkawinan (legalisir)</li>
            <li>Fotokopi KK orang tua (nama anak sudah tercantum)</li>
            <li>Fotokopi KTP orang tua (Ayah dan Ibu)</li>
            <li>Fotokopi KTP 2 orang saksi</li>
            <li>Surat kuasa bermaterai Rp 6.000 jika dikuasakan</li>
        </ul>

        <h3>Pencatatan Lahir Terlambat (>60 hari)</h3>
        <ul>
            <li>Surat keterangan kelahiran dari kelurahan/desa atau tenaga medis</li>
            <li>Fotokopi surat nikah/akta perkawinan (legalisir)</li>
            <li>Fotokopi KK orang tua</li>
            <li>Fotokopi KTP orang tua</li>
            <li>Fotokopi KTP 2 orang saksi</li>
            <li>Surat kuasa bermaterai Rp 6.000 jika dikuasakan</li>
            <li>Keputusan dari Kepala Dinas Dukcapil</li>
        </ul>
    </section>

    <section>
        <h2>Akta Kematian</h2>
        <ul>
            <li>Surat keterangan kematian dari RS/Puskesmas/Kepala Desa</li>
            <li>Fotokopi KK dan KTP</li>
            <li>Kutipan Akta Kelahiran (jika ada)</li>
            <li>Fotokopi KTP 2 orang saksi (usia ≥21 tahun)</li>
            <li>Bagi WNI keturunan: Surat bukti kewarganegaraan RI</li>
            <li>Bagi WNA: Fotokopi Passport dan dokumen imigrasi</li>
        </ul>
    </section>

    <section>
        <h2>Kartu Keluarga (KK)</h2>
        <h3>Penerbitan KK Baru</h3>
        <ul>
            <li>Pengantar dari RT/RW dan desa</li>
            <li>Keterangan Ijin Tinggal Tetap (WNA)</li>
            <li>Surat keterangan pindah</li>
            <li>Fotokopi akta kelahiran dan ijazah</li>
            <li>Fotokopi akta nikah</li>
        </ul>
        <h3>Perubahan Data KK</h3>
        <ul>
            <li>Pengantar dari RT/RW dan desa</li>
            <li>KK lama</li>
            <li>Dokumen pendukung perubahan</li>
        </ul>
    </section>

    <!-- Kamu bisa lanjutkan section ini untuk semua kategori persis seperti data panjang yang kamu kirim -->
</main>

<footer>
    &copy; 2025 Desa Sallo Cela. Semua Hak Dilindungi.
</footer>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
