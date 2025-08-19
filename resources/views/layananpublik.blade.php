<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Layanan Desa Sallo Cela</title>
<link rel="stylesheet" href="{{ asset('css/layanan.css') }}">
</head>
<body>

<header class="top-bar">
    <div class="left">
        <img src="{{ asset('images/logodesa.png') }}" alt="Logo" class="logo">
        <div>
            <div class="title">Desa Sallo Cela</div>
            <div class="subtitle">Kec. Muara Badak, Kab. Kutai Kartanegara,<br>
            Prov. Kalimantan Timur</div>
        </div>
    </div>
    
    <div class="right">
        <nav>
            <a href="{{route('beranda')}}">Home</a>
            <div class="has-dropdown">
                <a href="#">Profil Desa ▼</a>
                <div class="dropdown">
                    <a href="{{route('sejarah')}}">Sejarah Desa</a>
                    <a href="{{route('visi')}}">Visi & Misi</a>
                    <a href="{{route('struk')}}">Perangkat Desa</a>
                    <a href="{{route('peta')}}">Peta Administrasi</a>
                </div>
            </div>

            <div class="has-dropdown">
                <a href="#">Data Desa ▼</a>
                <div class="dropdown">
                    <a href="{{route('dapen')}}">Data Penduduk</a>
                </div>
            </div>

            <div class="has-dropdown">
                <a href="#">Kelembagaan ▼</a>
                <div class="dropdown">
                    <a href="{{route('bpd')}}">BPD</a>
                    <a href="{{route('karangtrn')}}">Karang Taruna</a>
                    <a href="{{route('ketua')}}">Ketua RT</a>
                    <a href="{{route('pkk')}}">PKK</a>
                </div>
            </div>

            <a href="{{route('potensi')}}">Potensi Desa</a>
            <a href="{{route('layanan')}}">Layanan</a>
        </nav>
    </div>
</header>

<nav>
    <div><a href="{{route('userWelcome')}}">Home</a></div>

     <div class="has-dropdown">
        <a href="#">Profil Desa ▼</a>
        <div class="dropdown">
            <a href="{{route('sejarah')}}">Sejarah Desa</a>
            <a href="{{route('visi')}}">Visi & Misi</a>
            <a href="{{route('struk')}}">Struktur Organisasi</a>
            <a href="{{route('peta')}}">Peta Administrasi</a>
        </div>
    </div>

    <div class="has-dropdown">
        <a href="#">Data Desa ▼</a>
        <div class="dropdown">
            <a href="{{route('dapen')}}">Data Penduduk</a>
        </div>
    </div>

    <div class="has-dropdown">
        <a href="#">Kelembagaan ▼</a>
        <div class="dropdown">
            <a href="{{route('bpd')}}">BPD</a>
            <a href="{{route('karangtrn')}}">Karang Taruna</a>
            <a href="{{route('ketua')}}">Ketua RT</a>
            <a href="{{route('pkk')}}">PKK</a>
        </div>
    </div>

    <div><a href="{{route('potensi')}}">Potensi Desa</a></div>
    <div><a href="{{route('layanan')}}">Layanan</a></div>

    <div><span class="search-icon" onclick="showSearch()">🔍</span></div>
</nav>

<section class="page-header">
    <h2>Layanan Administrasi Desa</h2>
</section>
<main>

    <div class="container">

        <!-- Kutipan Akta Kelahiran -->
        <div class="service">
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
        </div>

        <!-- Akta Kematian -->
        <div class="service">
            <h2>Akta Kematian</h2>
            <ul>
                <li>Surat keterangan kematian dari RS/Puskesmas/Kepala Desa</li>
                <li>Fotokopi KK dan KTP</li>
                <li>Kutipan Akta Kelahiran (jika ada)</li>
                <li>Fotokopi KTP 2 orang saksi (usia ≥21 tahun)</li>
                <li>Bagi WNI keturunan: Surat bukti kewarganegaraan RI</li>
                <li>Bagi WNA: Fotokopi Passport dan dokumen imigrasi</li>
            </ul>
        </div>

        <!-- Kartu Keluarga -->
        <div class="service">
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
        </div>

        <!-- Layanan lain bisa lanjut dengan format yang sama -->
    </div>
</main>


<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-column">
            <h4>Sekilas Pasekan</h4>
            <ul>
                <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="#">Peta</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Pemerintah</h4>
            <ul>
                <li><a href="{{ route('visi') }}">Visi Misi</a></li>
                <li><a href="{{ route('struk') }}">Perangkat Desa</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Info Publik</h4>
            <ul>
                <li><a href="#">Pengumuman</a></li>
                <li><a href="#">Infografis</a></li>
                <li><a href="#">Produk Hukum</a></li>
                <li><a href="#">Info Berkala</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} Desa Salo Cella. All Rights Reserved.
    </div>
</footer>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
