<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/sejarah.css') }}">
<title>Sejarah Desa Sallo Cela</title>
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

<footer>
    &copy; {{ date('Y') }} Desa Sallo Cela. Semua Hak Dilindungi.
</footer>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
