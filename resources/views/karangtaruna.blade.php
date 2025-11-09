<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/kartu.css') }}">
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
            <a href="{{route('berita')}}">Berita</a>
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
    <h2>Karang Taruna Desa Sallo Cela</h2>
</section>
<section class="krt-section">
<table border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; width: 100%; text-align: left;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th style="width: 50px; text-align:center;">No</th>
            <th>Nama</th>
            <th>Status Dalam Organisasi</th>
        </tr>
    </thead>
    {{-- <tbody>
        <tr>
            <td style="text-align:center;">1</td>
            <td>Muhammad Aris</td>
            <td>Ketua</td>
        </tr>
        <tr>
            <td style="text-align:center;">2</td>
            <td>Rahman</td>
            <td>Sekretaris</td>
        </tr>
        <tr>
            <td style="text-align:center;">3</td>
            <td>Udin</td>
            <td>Bendahara</td>
        </tr>
        <tr>
            <td style="text-align:center;">4</td>
            <td>Arif Hidayatullah</td>
            <td>Seksi Bidang Pendidikan</td>
        </tr>
        <tr>
            <td style="text-align:center;">5</td>
            <td>Budiman</td>
            <td>Seksi Bidang Pendidikan</td>
        </tr>
        <tr>
            <td style="text-align:center;">6</td>
            <td>Irwan Nur</td>
            <td>Seksi Bidang Pendidikan</td>
        </tr>
        <tr>
            <td style="text-align:center;">7</td>
            <td>Rusdi</td>
            <td>Seksi Bidang Usaha Kesejahteraan</td>
        </tr>
        <tr>
            <td style="text-align:center;">8</td>
            <td>Saripodding</td>
            <td>Seksi Bidang Usaha Kesejahteraan</td>
        </tr>
        <tr>
            <td style="text-align:center;">9</td>
            <td>Jumardi</td>
            <td>Seksi Bidang Usaha Kesejahteraan</td>
        </tr>
        <tr>
            <td style="text-align:center;">10</td>
            <td>Muh. Yunus</td>
            <td>Seksi Bidang Keagamaan</td>
        </tr>
        <tr>
            <td style="text-align:center;">11</td>
            <td>Ismanto</td>
            <td>Seksi Bidang Keagamaan</td>
        </tr>
        <tr>
            <td style="text-align:center;">12</td>
            <td>Irvan</td>
            <td>Seksi Bidang Keagamaan</td>
        </tr>
        <tr>
            <td style="text-align:center;">13</td>
            <td>Junaidi</td>
            <td>Seksi Bidang Kerohanian dan Pembinaan Mental</td>
        </tr>
        <tr>
            <td style="text-align:center;">14</td>
            <td>Suardi</td>
            <td>Seksi Bidang Kerohanian dan Pembinaan Mental</td>
        </tr>
        <tr>
            <td style="text-align:center;">15</td>
            <td>Zainal Abidin</td>
            <td>Seksi Bidang Kerohanian dan Pembinaan Mental</td>
        </tr>
        <tr>
            <td style="text-align:center;">16</td>
            <td>Rudi Rushandi</td>
            <td>Seksi Bidang Olahraga dan Seni Budaya</td>
        </tr>
        <tr>
            <td style="text-align:center;">17</td>
            <td>Wawan</td>
            <td>Seksi Bidang Olahraga dan Seni Budayan</td>
        </tr>
        <tr>
            <td style="text-align:center;">18</td>
            <td>Supriadi.B</td>
            <td>Seksi Bidang Lingkungan Hidup</td>
        </tr>
        <tr>
            <td style="text-align:center;">19</td>
            <td>Aldi Revaldi</td>
            <td>Seksi Bidang Lingkungan Hidup</td>
        </tr>
        <tr>
            <td style="text-align:center;">20</td>
            <td>Naharullah</td>
            <td>Seksi Bidang Humas dan Kerjasama Kemitraan</td>
        </tr>
        <tr>
            <td style="text-align:center;">21</td>
            <td>Nursamsu</td>
            <td>Seksi Bidang Humas dan Kerjasama Kemitraan</td>
        </tr>
    </tbody> --}}

    <tbody>
        @foreach ($datas as $item  )
            <tr>
                <td style="text-align:center;">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_anggota }}</td>
                <td>{{ $item->jabatan }}</td>
                </tr>
        @endforeach
    </tbody>
        
</table>
</section>



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
