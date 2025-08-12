<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/visimisi.css') }}">
<title>Visi & Misi - Desa Sallo Cela</title>
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
    <h2>Visi & Misi Desa Sallo Cela</h2>
</section>

<section class="visi-misi">
    <h3>Visi</h3>
    <p>"Mewujudkan masyarakat desa yang sejahtera dan damai melalui program-program yang berkelanjutan."</p>

    <h3>Misi</h3>
    <ol>
        <li>Melakukan reformasi kinerja aparatur pemerintah desa guna meningkatkan kualitas pelayanan kepada masyarakat yang prima, yaitu cepat, tepat, dan benar, serta menyelenggarakan pemerintah desa secara transparan, efisien, akuntabel, dan bertanggung jawab sesuai dengan perundang-undangan.</li>
        <li>Peningkatan/pembangunan di seluruh wilayah Desa Sallo Cela, baik desa, pemukiman, dan peningkatan sarana prasarana pertanian, perkebunan, perikanan, dan peternakan.</li>
        <li>Meningkatkan sarana dan prasarana dari segi fisik, ekonomi, pendidikan, kesehatan, olahraga, dan kebudayaan.</li>
        <li>Meningkatkan kesejahteraan masyarakat desa dengan mewujudkan usaha milik desa (BUMDes) dan program lain untuk membuka lapangan kerja bagi masyarakat desa.</li>
        <li>Menjalin komunikasi yang harmonis antara masyarakat, pemerintah dan lembaga desa, saling menghormati dalam kehidupan berbudaya.</li>
        <li>Memberdayakan semua potensi yang ada pada masyarakat yang meliputi:
            <ul>
                <li>Pemberdayaan sumber daya manusia (SDM)</li>
                <li>Pemberdayaan sumber daya alam (SDA)</li>
                <li>Pemberdayaan ekonomi masyarakat</li>
            </ul>
        </li>
    </ol>
</section>


<footer>
    &copy; 2025 Desa Sallo Cela. Semua Hak Dilindungi.
</footer>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
