<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/struktur.css') }}">
<title>Desa Sallo Cela</title>
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
    <h2>Struktur Organisasi Desa Sallo Cela</h2>
</section>

<section class="struktur-container">
    <!-- Kepala Desa -->
    <div class="card-biodata">
        <img src="{{ asset('images/kepala_desa.jpg') }}" alt="Kepala Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA KEPALA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Salama</li>
                <li><strong>Jabatan</strong> : Kepala Desa</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : </li>
                <li><strong>Pendidikan</strong> : </li>
                <li><strong>Agama</strong> : Islam</li>
                <li><strong>Alamat</strong> : Badak 1</li>
            </ul>
        </div>
    </div>

    <!-- Sekretaris Desa -->
    <div class="card-biodata">
        <img src="{{ asset('images/sekretaris_desa.jpg') }}" alt="Sekretaris Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA SEKRETARIS DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Feriansyah</li>
                <li><strong>Jabatan</strong> : Sekretaris Desa</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <!-- Bendahara Desa -->
    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Siti Aisyah</li>
                <li><strong>Jabatan</strong> : Bendahara Desa</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <!-- Tambahkan perangkat desa lainnya dengan format sama -->
     <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Rudy Rusandi</li>
                <li><strong>Jabatan</strong> : KASI KESRA</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Muhammad Yunus</li>
                <li><strong>Jabatan</strong> : KASI PLT Pemerintahan dan Perencanaan</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Nur Afiah</li>
                <li><strong>Jabatan</strong> : Staff Keuangan</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Usri</li>
                <li><strong>Jabatan</strong> : Staff KESRA</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Sulfiani</li>
                <li><strong>Jabatan</strong> : Staff KESRA</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Ardiansyah</li>
                <li><strong>Jabatan</strong> : Staff Perencanaan</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Abdul Razak</li>
                <li><strong>Jabatan</strong> : Staff Pemerintahan</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Herawati</li>
                <li><strong>Jabatan</strong> : Staff Pemerintahan</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Udin</li>
                <li><strong>Jabatan</strong> : Staff Desa</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>

    <div class="card-biodata">
        <img src="{{ asset('images/bendahara_desa.jpg') }}" alt="Bendahara Desa" class="foto-perangkat">
        <div class="biodata">
            <h3>BIODATA BENDAHARA DESA</h3>
            <ul>
                <li><strong>Nama</strong> : Surti Yanti</li>
                <li><strong>Jabatan</strong> : Staff Desa</li>
                <li><strong>Tempat/Tanggal Lahir</strong> : …</li>
                <li><strong>Pendidikan</strong> : …</li>
                <li><strong>Agama</strong> : …</li>
                <li><strong>Alamat</strong> : …</li>
            </ul>
        </div>
    </div>
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