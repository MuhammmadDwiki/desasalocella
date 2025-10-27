<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/visimisi.css') }}">
<link rel="icon" href="{{ asset('images/logodesa.png') }}">
<title>Visi & Misi - Desa Sallo Cela</title>
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

<nav>
    <div><a href="{{route('beranda')}}">Home</a></div>

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
</nav> 

<section class="page-header">

</section>


<!-- Bagian Visi -->
<section class="visi-misi-section">
  <div class="card">
    <h2 class="title">Visi</h2>
    <p>"Mewujudkan masyarakat desa yang sejahtera dan damai melalui program-program yang berkelanjutan."</p>
  </div>

  <!-- Bagian Misi -->
  <div class="card">
    <h2 class="title">Misi</h2>
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
  </div>
</section>

<section class="content">
    <h3>Asal Usul Desa</h3>
    <p>
        Desa Sallo Cela berdiri sejak puluhan tahun yang lalu sebagai salah satu pemukiman tertua di wilayah Kecamatan Muara Badak, Kabupaten Kutai Kartanegara. 
        Awalnya wilayah ini hanya berupa hamparan lahan hutan dan rawa yang dialiri oleh beberapa anak sungai kecil. 
        Sekelompok masyarakat dari daerah pesisir dan pedalaman datang untuk bermukim karena tanahnya subur dan dekat dengan sumber air. 
        Nama “Sallo Cela” sendiri berasal dari bahasa daerah setempat yang berarti “air yang menyejukkan,” 
        menggambarkan kondisi geografis desa yang dikelilingi sungai dan sumber air alami.
    </p>

    <h3>Perkembangan Desa</h3>
    <p>
        Pada awalnya, masyarakat Sallo Cela hidup dari hasil bercocok tanam padi ladang, menanam sayur-sayuran, 
        serta menangkap ikan di sungai dan rawa. Seiring berjalannya waktu, pemerintah mulai memperhatikan potensi wilayah ini. 
        Program pembangunan desa dimulai dengan membuka akses jalan, pembangunan jembatan, serta fasilitas umum seperti sekolah dan posyandu.
        <br><br>
        Tahun demi tahun, Desa Sallo Cela semakin berkembang menjadi pusat kegiatan ekonomi kecil menengah di wilayah sekitarnya. 
        Perkebunan kelapa sawit, karet, dan hortikultura menjadi sumber pendapatan tambahan bagi warga. 
        Selain itu, beberapa kelompok masyarakat membentuk usaha perikanan dan peternakan rakyat. 
        Kehidupan sosial pun mulai terbentuk dengan kuatnya semangat gotong royong antar warga, 
        terutama dalam pembangunan fasilitas umum seperti masjid, jalan desa, dan irigasi pertanian.
    </p>

    <h3>Kehidupan Masyarakat</h3>
    <p>
        Masyarakat Desa Sallo Cela dikenal ramah, terbuka, dan menjunjung tinggi nilai-nilai kekeluargaan. 
        Tradisi gotong royong masih sangat dijaga, terutama dalam kegiatan adat, pembangunan, dan acara kemasyarakatan. 
        Upacara adat seperti syukuran panen, selamatan sungai, dan kenduri kampung masih rutin dilaksanakan 
        sebagai wujud rasa syukur kepada Tuhan Yang Maha Esa atas hasil bumi yang melimpah.
        <br><br>
        Kini, Desa Sallo Cela terus bertransformasi menuju desa yang lebih maju dengan tetap mempertahankan kearifan lokalnya. 
        Pemerintah desa bersama masyarakat bekerja sama dalam berbagai program seperti pengembangan UMKM, pelestarian lingkungan, 
        serta digitalisasi data desa agar pelayanan publik menjadi lebih efisien dan transparan.
    </p>

    <h3>Kesimpulan</h3>
    <p>
        Desa Sallo Cela merupakan cerminan desa yang tumbuh dari semangat gotong royong dan kebersamaan masyarakatnya. 
        Dari sebuah pemukiman sederhana di tepi sungai, kini telah berkembang menjadi desa yang berdaya saing dan mandiri. 
        Dengan kekayaan alam yang melimpah dan masyarakat yang berbudaya, Sallo Cela memiliki potensi besar 
        untuk menjadi salah satu desa percontohan dalam pengelolaan sumber daya dan pelestarian tradisi di Kecamatan Muara Badak.
    </p>
</section>

<!-- Bagian Peta Desa -->
<div class="peta-section">
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
</div>

        
<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-column">
            <h4>Sekilas Salo Cella</h4>
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
