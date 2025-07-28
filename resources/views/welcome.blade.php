<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Desa Sallo Cela</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #fff;
        color: #222;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    header {
        background-color: #000;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        position: relative;
    }
    header h1 {
        font-size: 1.2em;
        margin: 0;
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    header h1 img {
        height: 30px;
        margin-right: 10px;
    }
    header h1 .subinfo {
        font-size: 0.8em;
        color: #ccc;
    }
    nav {
        display: flex;
        align-items: center;
    }
    nav > div {
        position: relative;
        margin: 0 10px;
    }

    nav > div > a:hover {
    color: red !important;
    }

    nav a {
        color: white;
        text-decoration: none;
        font-size: 0.9em;
        padding: 5px;
    }
    nav a:hover {
        color: #e60000;
    }
    .dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #222;
        padding: 10px;
        border-radius: 4px;
        min-width: 200px;
        z-index: 10;
    }
    .dropdown a {
        display: block;
        color: white;
        padding: 5px 10px;
    }
    .dropdown a:hover {
        background: #222;
        color: red !important;
    }
    .has-dropdown:hover .dropdown {
        display: block;
    }

    .search-icon {
        cursor: pointer;
        font-size: 1.2em;
        margin-left: 15px;
    }
    .hero {
        position: relative;
        background: url('{{ asset("images/bgdesa.jpeg") }}') center/cover no-repeat;
        text-align: center;
        color: white;
        padding: 80px 20px;
    }
    .hero::after {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
    }
    .hero h2 {
        margin: 0;
        font-size: 2.2em;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
    }
    .hero p {
        font-size: 1em;
        margin: 10px 0 0;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
    }
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 15px;
        padding: 20px;
        max-width: 1000px;
        margin: auto;
        flex: 1;
    }
    .card {
        background: #e60000;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        text-align: center;
        border-top: 4px solid #000;
        color: #fff;
    }
    .card h3 {
        margin: 10px 0;
        font-size: 1em;
        color: #fff;
    }
    .card p {
        font-size: 0.9em;
        color: #fff;
    }
    .card .icon {
        font-size: 2em;
        color: #fff;
    }
    footer {
        background-color: #000;
        color: white;
        text-align: center;
        padding: 10px;
        font-size: 0.9em;
        margin-top: 20px;
    }
</style>
</head>
<body>

<header style="background: #e60000; color: white; padding: 10px; display: flex; justify-content: flex-start; align-items: center;">
    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="height: 70px; margin-right: 15px;">
    <div>
        <div style="font-size: 1.8em; font-weight: bold;">Desa Sallo Cela</div>
        <div style="font-size: 1em; margin-top: 5px;">
            Kec. Muara Badak, Kab. Kutai Kartanegara,<br>
            Prov. Kalimantan Timur
        </div>
    </div>
</header>

<nav style="background: #000; color: white; display: flex; justify-content: center; align-items: center; padding: 10px 0;">
    <div><a href="#" style="color:white; text-decoration:none; margin:0 10px;">🏠</a></div>

    <div class="has-dropdown" style="position:relative; margin:0 10px;">
        <a href="#" style="color:white; text-decoration:none;">Profil Desa ▼</a>
        <div class="dropdown" style="display:none; position:absolute; top:100%; left:0; background:#222; padding:10px; border-radius:4px; min-width:200px; z-index:10;">
            <a href="{{route('profile')}}" style="color:white; display:block; margin-bottom:5px;">Profil Kepala Desa</a>
            <a href="{{route('sejarah')}}" style="color:white; display:block; margin-bottom:5px;">Sejarah Desa</a>
            <a href="{{route('visi')}}" style="color:white; display:block; margin-bottom:5px;">Visi & Misi</a>
            <a href="{{route('struk')}}" style="color:white; display:block;">Struktur Organisasi</a>
        </div>
    </div>

    <div class="has-dropdown" style="position:relative; margin:0 10px;">
        <a href="#" style="color:white; text-decoration:none;">Data Desa ▼</a>
        <div class="dropdown" style="display:none; position:absolute; top:100%; left:0; background:#222; padding:10px; border-radius:4px; min-width:200px; z-index:10;">
            <a href="{{route('dapen')}}" style="color:white; display:block; margin-bottom:5px;">Data Penduduk</a>
            <a href="{{route('anggaran')}}" style="color:white; display:block; margin-bottom:5px;">Anggaran Desa</a>
        </div>
    </div>

    <div class="has-dropdown" style="position:relative; margin:0 10px;">
        <a href="#" style="color:white; text-decoration:none;">Kelembagaan ▼</a>
        <div class="dropdown" style="display:none; position:absolute; top:100%; left:0; background:#222; padding:10px; border-radius:4px; min-width:200px; z-index:10;">
            <a href="{{route('bpd')}}" style="color:white; display:block; margin-bottom:5px;">BPD</a>
            <a href="{{route('karangtrn')}}" style="color:white; display:block; margin-bottom:5px;">Karang Taruna</a>
            <a href="{{route('ketua')}}" style="color:white; display:block; margin-bottom:5px;">Ketua RT</a>
            <a href="{{route('linmass')}}" style="color:white; display:block; margin-bottom:5px;">Linmas</a>
            <a href="{{route('posy')}}" style="color:white; display:block; margin-bottom:5px;">Posyandu</a>
            <a href="{{route('pkk')}}" style="color:white; display:block;">PKK</a>
        </div>
    </div>

    <div><a href="{{route('potensi')}}" style="color:white; text-decoration:none; margin:0 10px;">Potensi Desa</a></div>
    <div><a href="{{route('layanan')}}" style="color:white; text-decoration:none; margin:0 10px;">Layanan</a></div>

    <div><span class="search-icon" onclick="showSearch()" style="cursor:pointer; margin-left:15px;">🔍</span></div>
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

<footer>
    &copy; {{ date('Y') }} Desa Sallo Cela. Semua Hak Dilindungi.
</footer>

<script>
document.querySelectorAll('.has-dropdown').forEach(item => {
    item.addEventListener('mouseenter', () => {
        item.querySelector('.dropdown').style.display = 'block';
    });
    item.addEventListener('mouseleave', () => {
        item.querySelector('.dropdown').style.display = 'none';
    });
});

function showSearch() {
    const term = prompt("Masukkan kata kunci pencarian:");
    if (term) {
        alert("Anda mencari: " + term);
    }
}
</script>

</body>
</html>