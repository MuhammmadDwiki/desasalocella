<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/bpd.css') }}">
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

<section class="page-header">
    <h2>Karang Taruna Desa Sallo Cela</h2>
</section>

<table border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; width: 100%; text-align: left;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th style="width: 50px; text-align:center;">No</th>
            <th>Nama</th>
            <th>Status Dalam Organisasi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:center;">1</td>
            <td>Dr.Ns.Putri Jamal, S.ST., M.Kes. Ph.d</td>
            <td>Ketua</td>
        </tr>
        <tr>
            <td style="text-align:center;">2</td>
            <td>Jumriani. SE</td>
            <td>Wakil Ketua</td>
        </tr>
        <tr>
            <td style="text-align:center;">3</td>
            <td>Erwin</td>
            <td>Sekretaris</td>
        </tr>
        <tr>
            <td style="text-align:center;">4</td>
            <td>Hasnani</td>
            <td>Anggota</td>
        </tr>
        <tr>
            <td style="text-align:center;">5</td>
            <td>Sitti Harsiah</td>
            <td>Anggota</td>
        </tr>
    </tbody>
</table>



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
