<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Desa Sallo Cela</title>
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
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
    <div><a href="#">🏠</a></div>

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

<section class="hero">
    <div class="hero-content">
        <h2>SELAMAT DATANG DI<br> DESA SALLO CELA</h2>
        <p>Website Resmi Desa Sallo Cela</p>
    </div>
</section>

<section class="cards">
    <div class="card">
        <div class="icon">🏛️</div>
        <h3>Struktur Pemerintahan</h3>
        <p>Informasi mengenai susunan organisasi pemerintahan Desa Sallo Cela</p>
    </div>
    <div class="card">
        <div class="icon">📍</div>
        <h3>Potensi Wilayah</h3>
        <p>Eksplorasi potensi dan sumber daya alam yang dimiliki desa</p>
    </div>
    <div class="card">
        <div class="icon">👥</div>
        <h3>Kegiatan Masyarakat</h3>
        <p>Berita terbaru seputar aktivitas dan acara yang berlangsung di desa</p>
    </div>
    <div class="card">
        <div class="icon">📝</div>
        <h3>Layanan Publik</h3>
        <p>Informasi tentang layanan publik yang tersedia bagi masyarakat desa</p>
    </div>
</section>

{{-- Bagian Selikas Desa Salo Cella --}}
<section class="stats">
    <h2>Sekilas Salo Cella</h2>
    <div class="stats-grid">
        <div class="stat-card">
            <h3>🌦️ Cuaca</h3>
            <ul>
                <li>12 Aug 03:00 → 27.95°C</li>
                <li>12 Aug 06:00 → 30.86°C</li>
                <li>12 Aug 09:00 → 30.76°C</li>
                <li>12 Aug 12:00 → 27.82°C</li>
                <li>12 Aug 15:00 → 26.78°C</li>
                <li>12 Aug 18:00 → 26.05°C</li>
                <li>12 Aug 21:00 → 22.19°C</li>
                <li>13 Aug 00:00 → 23.32°C</li>
                <li>13 Aug 03:00 → 29.19°C</li>
                <li>13 Aug 06:00 → 31.76°C</li>
                <li>13 Aug 09:00 → 29.14°C</li>
                <li>13 Aug 12:00 → 26.1°C</li>
            </ul>
        </div>
        <div class="stat-card">
            <h3>❤️ Kesehatan</h3>
            <p>Puskesmas II Eromoko</p>
            <p>PKD Desa Pasekan</p>
            <p>Pos Yandu Balita: 8 Unit</p>
            <p>Pos Yandu Lansia: 3 Unit</p>
            <p>Sarana Air Bersih</p>
            <p>Jamban Keluarga tersedia</p>
            <p>Balai Kesehatan Ibu dan Anak</p>
        </div>
        <div class="stat-card">
            <h3>🧒 Posyandu</h3>
            <p>Balita: 190 Anak</p>
            <p>Lansia: 105 Jiwa</p>
            <p>Data posyandu diperbarui secara berkala</p>
        </div>
        <div class="stat-card">
            <h3>🏫 Sekolah</h3>
            <p>PAUD: 3 unit</p>
            <p>SD: 2 unit</p>
            <p>SMP: 1 unit</p>
        </div>
        <div class="stat-card">
            <h3>👥 Kependudukan</h3>
            <p>Laki-laki: 51%</p>
            <p>Perempuan: 49%</p>
            <p>Total: 2.361 jiwa</p>
        </div>
    </div>
</section>


<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-column">
            <h4>Sekilas Pasekan</h4>
            <ul>
                <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                <li><a href="#">Sekilas Pasekan</a></li>
                <li><a href="#">Profil</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Pemerintah</h4>
            <ul>
                <li><a href="{{ route('visi') }}">Visi Misi</a></li>
                <li><a href="#">SOT</a></li>
                <li><a href="{{ route('struk') }}">Struktur Organisasi</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Info Publik</h4>
            <ul>
                <li><a href="#">Pengumuman</a></li>
                <li><a href="#">Infografis</a></li>
                <li><a href="#">Produk Hukum</a></li>
                <li><a href="#">Info Berkala</a></li>
                <li><a href="#">Info serta merta</a></li>
                <li><a href="#">Info setiap saat</a></li>
                <li><a href="#">DIP</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} Desa Pasekan. All Rights Reserved.
    </div>
</footer>


<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
