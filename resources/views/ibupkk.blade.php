<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/pkk.css') }}">
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
    <h2>Data PKK Desa Sallo Cela</h2>
</section>

<!-- Tabel Pengurus -->
<table border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; width: 100%; text-align: left; margin-bottom:20px;">
    <thead style="background:#f2f2f2;">
        <tr>
            <th style="width:50px; text-align:center;">No</th>
            <th style="width:150px;">Jabatan</th>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="text-align:center;">1</td>
            <td>Ketua</td>
            <td>Herlina, S.Pd</td>
        </tr>
        <tr style="background:#f9f9f9;">
            <td style="text-align:center;">2</td>
            <td>Wakil Ketua</td>
            <td>Alisa Tansil</td>
        </tr>
        <tr>
            <td style="text-align:center;">3</td>
            <td>Sekretaris</td>
            <td>Hj. Hasnah</td>
        </tr>
        <tr style="background:#f9f9f9;">
            <td style="text-align:center;">4</td>
            <td>Bendahara</td>
            <td>Novarianti</td>
    </tbody>
</table>

<!-- Tabel Pokja -->
<table border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; width: 100%; text-align: center;">
    <thead style="background:#f2f2f2;">
        <tr>
            <th style="width:50px;">No</th>
            <th>Pokja 1</th>
            <th>Pokja 2</th>
            <th>Pokja 3</th>
            <th>Pokja 4</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Hj. Sitti Hamidah (Ketua)</td>
            <td>Astriyana (Ketua)</td>
            <td>Hasmiati Nur (Ketua)</td>
            <td>Wahida (Ketua)</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Saripah (Wakil)</td>
            <td>Lilis Suryani (Wakil)</td>
            <td>Sulfiani (Wakil)</td>
            <td>Riztika U S(Wakil)</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Sumarni (Sekretaris)</td>
            <td>Agustina (Sekretaris)</td>
            <td>Hikma Adriani (Sekretaris)</td>
            <td>Wiwi Narti (Sekretaris)</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Ani (Anggota)</td>
            <td>Hermiyanti (Anggota)</td>
            <td>Mariani (Anggota)</td>
            <td>Fitriani (Anggota)</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Mulyati (Anggota)</td>
            <td>Sunarti (Anggota)</td>
            <td>Sumi (Anggota)</td>
            <td>Asni (Anggota)</td>
        </tr>
    </tbody>
</table>


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