<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Sallo Cela</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="icon" href="{{ asset('images/logodesa.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <a href="{{ route('beranda') }}">Home</a>
                <div class="has-dropdown">
                    <a href="#">Profil Desa ▼</a>
                    <div class="dropdown">
                        <a href="{{ route('visi') }}">Visi & Misi</a>
                        <a href="{{ route('struk') }}">Perangkat Desa</a>
                    </div>
                </div>

                <div class="has-dropdown">
                    <a href="#">Data Desa ▼</a>
                    <div class="dropdown">
                        <a href="{{ route('dapen') }}">Data Penduduk</a>
                    </div>
                </div>

                <div class="has-dropdown">
                    <a href="#">Kelembagaan ▼</a>
                    <div class="dropdown">
                        <a href="{{ route('bpd') }}">BPD</a>
                        <a href="{{ route('karangtrn') }}">Karang Taruna</a>
                        <a href="{{ route('ketua') }}">Ketua RT</a>
                        <a href="{{ route('pkk') }}">PKK</a>
                    </div>
                </div>

                <a href="{{ route('potensi') }}">Potensi Desa</a>
                <a href="{{ route('layanan') }}">Layanan</a>
                <a href="{{ route('berita') }}">Berita</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <video autoplay muted loop playsinline class="hero-video">
            <source src="{{ asset('videos/bgdesa.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-content">
            <h2>SELAMAT DATANG DI<br> DESA SALLO CELA</h2>
            <p>Website Resmi Desa Sallo Cela</p>
        </div>
    </section>

    <section class="stats">
        <h2>Sekilas Salo Cella</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <h3>🗺️ Peta Lokasi</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7820852681!2d117.34240417303133!3d-0.2441889353709371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5e7c168b77d4b%3A0x8222e6267d6bad0c!2sKantor%20Desa%20Salo%20Cella!5e0!3m2!1sid!2sid!4v1758904548969!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="stat-column">
                <div class="stat-card kesehatan-card">
                    <h3>❤️ Kesehatan</h3>
                    <p>POLINDES 1 Unit</p>
                    <p>PUSBAN 1 Unit</p>
                    <p>POSBINDU 2 Unit</p>
                    <p>Layanan Lansia 2 Unit</p>
                </div>

                <div class="stat-card">
                    <h3>🕌 Peribadahan</h3>
                    <p>Masjid/Mushola 10 Unit</p>
                </div>
            </div>
            <div class="stat-column">
                <div class="stat-card sekolah-card">
                    <h3>🏫 Sekolah</h3>
                    <p>PAUD: 3 unit</p>
                    <p>SD: 1 unit</p>
                    <p>SMP: 1 unit</p>
                </div>

                <div class="stat-card">
                    <h3>👥 Kependudukan</h3>
                    <div class="population-stats">
                        <div>
                            <p>Laki-laki</p>
                            <p>51%</p>
                        </div>
                        <div>
                            <p>Perempuan</p>
                            <p>49%</p>
                        </div>
                    </div>
                    <div class="population-total">
                        <p>Jumlah</p>
                        <p>2.361 jiwa</p>
                    </div>
                    <p>Jumlah penduduk diupdate secara berkala.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-info">
        <div class="contact-left">
            <img src="{{ asset('images/logodesa.png') }}" alt="Logo Desa" class="contact-logo">
            <div>
                <h3>Desa Sallo Cela</h3>
                <p>Kec. Muara Badak, Kab. Kutai Kartanegara,<br>Prov. Kalimantan Timur</p>
            </div>
        </div>
        <div class="contact-right">
            <div class="contact-card">
                <span>📧</span>
                <div>
                    <strong>Email</strong>
                    <p>desasallocella@gmail.com</p>
                </div>
            </div>
            <div class="contact-card">
                <span>🕒</span>
                <div>
                    <strong>Jam Layanan</strong>
                    <p>Senin - Kamis: 08.00 – 15.00</p>
                </div>
            </div>
            <div class="contact-card">
                <span><i class="fa-brands fa-instagram" style="color:#E4405F;"></i></span>
                <div>
                    <strong>Instagram</strong>
                    <p><a href="https://www.instagram.com/desasalocella" target="_blank">@desasallocella</a></p>
                </div>
            </div>

            <div class="contact-card">
                <span><i class="fa-brands fa-facebook" style="color:#1877F2;"></i></span>
                <div>
                    <strong>Facebook</strong>
                    <p><a href="https://www.facebook.com/profile.php?id=100089583949440&rdid=mY5DaLRUO6BwF7le"
                            target="_blank">Desa Sallo Cela</a></p>
                </div>
            </div>
            <div class="contact-card">
                <span><i class="fa-brands fa-youtube" style="color:#f21823;"></i></span>
                <div>
                    <strong>Youtube</strong>
                    <p><a href="https://www.youtube.com/@salocellatvofficial2567"
                            target="_blank">SALOCELLATV OFFICIAL</a></p>
                </div>
            </div>

            <div class="contact-card">
                <span><i class="fa-brands fa-tiktok" style="color:#000;"></i></span>
                <div>
                    <strong>TikTok</strong>
                    <p><a href="https://www.tiktok.com/@desasalocella" target="_blank">@desasallocella</a></p>
                </div>
            </div>

        </div>
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
