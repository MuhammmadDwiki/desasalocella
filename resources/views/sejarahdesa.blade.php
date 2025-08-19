<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/sejarah.css') }}">
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
            <a href="{{route('linmass')}}">Linmas</a>
            <a href="{{route('posy')}}">Posyandu</a>
            <a href="{{route('pkk')}}">PKK</a>
        </div>
    </div>

    <div><a href="{{route('potensi')}}">Potensi Desa</a></div>
    <div><a href="{{route('layanan')}}">Layanan</a></div>

    <div><span class="search-icon" onclick="showSearch()">🔍</span></div>
</nav> --}}

<section class="page-header">
    <h2>Sejarah Desa Sallo Cela</h2>
</section>

<section class="content">
    <h3>Asal Usul Desa</h3>
    <p>
        Desa Sallo Cela berdiri sejak puluhan tahun yang lalu sebagai salah satu pemukiman yang berkembang di wilayah Kecamatan Muara Badak.
        Awalnya desa ini merupakan kumpulan beberapa kelompok masyarakat yang menetap di sekitar daerah aliran sungai untuk bercocok tanam dan menangkap ikan.
    </p>

    <h3>Perkembangan Desa</h3>
    <p>
        Seiring berjalannya waktu, Desa Sallo Cela berkembang menjadi pusat kegiatan pertanian, perkebunan, perikanan, dan peternakan di wilayahnya.
        Pembangunan infrastruktur seperti jalan, jembatan, dan fasilitas umum mulai dibangun untuk mendukung aktivitas masyarakat.
    </p>

    <h3>Kehidupan Masyarakat</h3>
    <p>
        Masyarakat Desa Sallo Cela dikenal memiliki nilai kebersamaan, gotong royong, dan menjunjung tinggi adat istiadat setempat.
        Hingga kini, desa ini terus berkembang menuju masyarakat yang sejahtera dengan tetap menjaga tradisi dan kearifan lokal.
    </p>
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
