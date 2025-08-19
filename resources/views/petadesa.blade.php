<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Desa - Desa Sallo Cela</title>
    <link rel="stylesheet" href="{{ asset('css/petadesa.css') }}">
</head>
<body>
    <header>
    <img src="{{ asset('images/logodesa.png') }}" alt="Logo" class="logo">
    <div>
        <div class="title">Desa Sallo Cela</div>
        <div class="subtitle">
            Kec. Muara Badak, Kab. Kutai Kartanegara,<br>
            Prov. Kalimantan Timur
        </div>
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
        <h2>Peta Desa Sallo Cela</h2>
    </section>

   <section class="peta-container">
    <h2>Peta Administrasi Desa Salo Cella</h2>
    <img src="{{ asset('images/petadesa.png') }}" alt="Peta Administrasi Desa Sallo Cela">
    <p class="peta-deskripsi">
        Peta Administrasi Desa Salo Cella menampilkan batas wilayah desa, sungai, jalan,
        serta pemukiman. Peta ini berguna untuk memberikan gambaran umum wilayah
        administrasi desa beserta posisi strategisnya di Kecamatan Muara Badak.
    </p>
</section>

<section class="peta-container">
    <h2>Peta Batas RT Desa Salo Cella</h2>
    <img src="{{ asset('images/petabatasrt.png') }}" alt="Peta Batas RT Desa Sallo Cela">
    <p class="peta-deskripsi">
        Peta Batas RT Desa Salo Cella memperlihatkan pembagian wilayah berdasarkan
        Rukun Tetangga (RT). Peta ini menunjukkan luas wilayah masing-masing RT yang
        dapat digunakan untuk perencanaan pembangunan dan pelayanan masyarakat.
    </p>
</section>

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-column">
            <h4>Sekilas Pasekan</h4>
            <ul>
                <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
<<<<<<< HEAD
                <li><a href="#">Sekilas Pasekan</a></li>
                <li><a href="#">Profil</a></li>
=======
                <li><a href="#">Profil</a></li>
                <li><a href="#">Peta</a></li>
>>>>>>> 79f6e4b622537762a184531677308cfb0c3f8e1c
            </ul>
        </div>
        <div class="footer-column">
            <h4>Pemerintah</h4>
            <ul>
                <li><a href="{{ route('visi') }}">Visi Misi</a></li>
<<<<<<< HEAD
                <li><a href="#">SOT</a></li>
                <li><a href="{{ route('struk') }}">Struktur Organisasi</a></li>
=======
                <li><a href="{{ route('struk') }}">Perangkat Desa</a></li>
>>>>>>> 79f6e4b622537762a184531677308cfb0c3f8e1c
            </ul>
        </div>
        <div class="footer-column">
            <h4>Info Publik</h4>
            <ul>
                <li><a href="#">Pengumuman</a></li>
                <li><a href="#">Infografis</a></li>
                <li><a href="#">Produk Hukum</a></li>
                <li><a href="#">Info Berkala</a></li>
<<<<<<< HEAD
                <li><a href="#">Info serta merta</a></li>
                <li><a href="#">Info setiap saat</a></li>
                <li><a href="#">DIP</a></li>
=======
>>>>>>> 79f6e4b622537762a184531677308cfb0c3f8e1c
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
