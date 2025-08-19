<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <link rel="stylesheet" href="datapenduduk.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/datapenduduk.css') }}">
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
{{-- 
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
    <h2>Data Penduduk Desa Sallo Cela</h2>
</section>

<p>
    Halaman Data Desa ini berisi informasi mengenai Basis Data Desa Salo Cella. 
    Data yang disajikan dalam halaman ini, yakni basis data kependudukan dan data desa lainnya 
    yang diolah secara berkelanjutan.
</p>

<!-- ===== Grafik Jumlah Penduduk ===== -->
<div class="chart-container">
    <h4>Jumlah Penduduk</h4>
    <canvas id="chartPenduduk"></canvas>
</div>

<!-- ===== Grafik Jumlah KK ===== -->
<div class="chart-container">
    <h4>Jumlah KK</h4>
    <canvas id="chartKK"></canvas>
</div>

<!-- ===== Grafik Agama ===== -->
<div class="chart-container">
    <h4>Agama</h4>
    <canvas id="chartAgama"></canvas>
</div>

<script>
    const penduduk = @json($penduduk);
    
    // Hitung persentase
    const total = penduduk.totalLaki + penduduk.totalPerempuan;
    const persenLaki = ((penduduk.totalLaki / total) * 100).toFixed(1);
    const persenPerempuan = ((penduduk.totalPerempuan / total) * 100).toFixed(1);
    // console.log(penduduk)
    
    // ===== Grafik Jumlah Penduduk =====
    new Chart(document.getElementById('chartPenduduk'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                 data: [persenLaki, persenPerempuan],
                backgroundColor: ['#1E56E7', '#E23B0F']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: true,
            plugins: {
                legend: { position: 'right' },
                tooltip: {
                    callbacks: { label: ctx => ctx.label + ': ' + ctx.parsed + '%' }
                }
            }
        }
    });

    // ===== Grafik Jumlah KK =====
    new Chart(document.getElementById('chartKK'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [75.7, 24.3],
                backgroundColor: ['#1E56E7', '#E23B0F']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: true,
            plugins: {
                legend: { position: 'right' },
                tooltip: {
                    callbacks: { label: ctx => ctx.label + ': ' + ctx.parsed + '%' }
                }
            }
        }
    });

    // ===== Grafik Agama =====
    new Chart(document.getElementById('chartAgama'), {
        type: 'pie',
        data: {
            labels: ['Islam', 'Kristen'],
            datasets: [{
                data: [95.8, 4.2],
                backgroundColor: ['#1E56E7', '#E23B0F']
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: true,
            plugins: {
                legend: { position: 'right' },
                tooltip: {
                    callbacks: { label: ctx => ctx.label + ': ' + ctx.parsed + '%' }
                }
            }
        }
    });
</script>


<script src="{{ asset('js/script.js') }}"></script>

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

</body>
</html>
