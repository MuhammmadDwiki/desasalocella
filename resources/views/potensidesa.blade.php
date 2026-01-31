<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/potensi.css') }}">
<link rel="icon" href="{{ asset('images/logodesa.png') }}">
<title>Sejarah Desa Sallo Cela</title>
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
                    <a href="{{route('visi')}}">Visi & Misi</a>
                    <a href="{{route('struk')}}">Perangkat Desa</a>
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
            <a href="{{route('berita')}}">Berita</a>

        </nav>
    </div>
</header>


<section class="page-header">
    <h2>Potensi Desa Sallo Cela</h2>
</section>

<section class="content">
    <h3>Potensi Desa</h3>
    <p>
        Desa Sallo Cela memiliki berbagai potensi yang dapat mendukung kesejahteraan masyarakat dan kemajuan wilayah, antara lain:
    </p>
    <ul>
        <li><strong>Pertanian dan Perkebunan:</strong> Potensi lahan yang luas untuk pengembangan kelapa sawit, karet, serta tanaman pangan lainnya.</li>
        <li><strong>Perikanan:</strong> Didukung oleh sungai dan perairan sekitar yang menjadi sumber ikan air tawar.</li>
        <li><strong>Peternakan:</strong> Potensi pengembangan ternak seperti sapi, kambing, dan unggas.</li>
        <li><strong>Sumber Daya Alam:</strong> Terdapat sumur minyak dan gas bumi yang dikelola oleh perusahaan, memberikan kontribusi ekonomi bagi masyarakat.</li>
    </ul>
</section>


<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-column">
            <h4>Sekilas Desa Salo Cella</h4>
            <ul>
                <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                <li><a href="#">Sekilas Desa Salo Cella</a></li>
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
