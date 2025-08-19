<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Desa Sallo Cela</title>
<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
<link rel="icon" href="{{ asset('images/logodesa.png') }}">

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

{{-- <nav>
    <div><a href="userWelcome">Home</a></div>

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
</nav> --}}

<section class="hero">
    <video autoplay muted loop playsinline class="hero-video">
        <source src="{{ asset('videos/bgdesaa.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-content">
        <h2>SELAMAT DATANG DI<br> DESA SALLO CELA</h2>
        <p>Website Resmi Desa Sallo Cela</p>
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
        <div class="stat-column">
        <div class="stat-card kesehatan-card">
            <h3>❤️ Kesehatan</h3>
            <p>POLINDES 1 Unit</p>
            <p>PUSBAN 1 Unit</p>
            <p>POSBINDU 2 Unit</p>
            <p>Layanan Lansia 2 Unit</p>
        </div>

         <div class="stat-card">
            <h3>🕌 Peribadahan</h3>
            <p>Masjid/Mushola 10 Unit</p>
        </div>
        </div>
        <div class="stat-column">
        <div class="stat-card sekolah-card">
            <h3>🏫 Sekolah</h3>
            <p>PAUD: 3 unit</p>
            <p>SD: 1 unit</p>
            <p>SMP: 1 unit</p>
        </div>

        <div class="stat-card">
            <h3>👥 Kependudukan</h3>
            <div class="population-stats">
                <div>
                    <p>Laki-laki</p>
                    <p>51%</p>
                </div>
                <div>
                    <p>Perempuan</p>
                    <p>49%</p>
                </div>
            </div>
            <div class="population-total">
                <p>Jumlah</p>
                <p>2.361 jiwa</p>
            </div>
            <p>Jumlah penduduk diupdate secara berkala.</p>
        </div>
    </div>
    </div>
</section>

<section class="contact-info">
    <div class="contact-left">
        <img src="{{ asset('images/logodesa.png') }}" alt="Logo Desa" class="contact-logo">
        <div>
            <h3>Desa Sallo Cela</h3>
            <p>Kec. Muara Badak, Kab. Kutai Kartanegara,<br>Prov. Kalimantan Timur</p>
        </div>
    </div>
    <div class="contact-right">
        <div class="contact-card">
            <span>📧</span>
            <div>
                <strong>Email</strong>
                <p>desasallocella@gmail.com</p>
            </div>
        </div>
        <div class="contact-card">
            <span>👥</span>
            <div>
                <strong>Pengunjung</strong>
                <p>Jumlah pengunjung: 344,652</p>
            </div>
        </div>
        <div class="contact-card">
            <span>🕒</span>
            <div>
                <strong>Jam Layanan</strong>
                <p>Senin - Kamis: 08.00 – 15.00</p>
            </div>
        </div>
    </div>
</section>


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
