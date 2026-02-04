@extends('layouts.app')

@section('title', 'Beranda - Desa Salo Cella')

@section('content')
    {{-- Hero Section with Full Premium Look --}}
    <section class="relative w-full h-[100vh] overflow-hidden flex items-center justify-center text-white text-center">
        <video autoplay muted loop playsinline
            class="absolute top-1/2 left-1/2 min-w-full min-h-full object-cover -translate-x-1/2 -translate-y-1/2 z-0 scale-105 transition-transform duration-[20s] ease-linear hover:scale-110">
            <source src="{{ asset('videos/bgdesa.mp4') }}" type="video/mp4">
        </video>
        <div
            class="absolute top-0 left-0 w-full h-full bg-black/40 bg-gradient-to-b from-black/60 via-transparent to-black/60 z-[1]">
        </div>

        <div class="relative z-[2] px-4" data-aos="fade-up" data-aos-duration="1500">
            <h1 class="text-xs md:text-sm font-bold uppercase tracking-[0.5em] mb-4 text-red-500 drop-shadow-md">Selamat
                Datang di Portal Resmi</h1>
            <h2 class="m-0 text-5xl md:text-7xl lg:text-8xl font-black leading-none drop-shadow-2xl">
                DESA<br><span class="text-white/90">SALO CELLA</span>
            </h2>
            <div class="h-1 w-24 bg-red-600 mx-auto my-8"></div>
            <p class="text-lg md:text-2xl font-light max-w-2xl mx-auto opacity-90 drop-shadow-lg leading-relaxed">
                Membangun Kemandirian, Menjaga Tradisi, Menggapai Masa Depan Digital.
            </p>

            <div class="mt-12">
                <a href="#tentang"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-10 rounded-full transition-all duration-300 transform hover:scale-105 shadow-xl inline-flex items-center gap-2">
                    Jelajahi Desa <i class="fa-solid fa-arrow-down-long animate-bounce"></i>
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-[2] opacity-50 hidden md:block">
            <div class="w-6 h-10 border-2 border-white rounded-full flex justify-center p-1">
                <div class="w-1.5 h-1.5 bg-white rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>

    {{-- Welcome Message / About Section --}}
    <section id="tentang" class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 md:px-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                {{-- Left: Image with Stylized Frame --}}
                <div class="w-full lg:w-1/2 relative" data-aos="fade-right">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-red-100 rounded-full z-0 opacity-50"></div>
                    <div class="absolute -bottom-10 -right-10 w-60 h-60 bg-gray-100 rounded-full z-0 opacity-50"></div>
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border-8 border-white group">
                        <img src="{{ asset('images/petadesa.png') }}" alt="Peta Desa"
                            class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-bottom p-8 flex-col justify-end">
                            <h4 class="text-white font-bold text-2xl">Geografis Salo Cella</h4>
                            <p class="text-white/80 text-sm">Terletak di jantung Kec. Muara Badak, Kalimantan Timur.</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Text Content --}}
                <div class="w-full lg:w-1/2 text-left" data-aos="fade-left">
                    <span class="text-red-600 font-bold uppercase tracking-widest text-sm">— Tentang Desa Kami</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mt-4 mb-8 leading-tight">Harmoni dalam
                        Keragaman, Mandiri dalam Pembangunan</h2>
                    <p class="text-gray-600 leading-relaxed mb-6 text-lg">
                        Desa Salo Cella merupakan oase pembangunan yang memadukan keindahan alam tropis dengan modernitas
                        pelayanan publik. Dengan semangat gotong royong, kami terus berinovasi dalam sektor pertanian,
                        perikanan, dan infrastruktur digital.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-8 text-lg italic">
                        "Visi kami adalah menciptakan masyarakat yang mandiri melalui digitalisasi pelayanan dan penguatan
                        ekonomi lokal yang berkelanjutan."
                    </p>

                    <div class="flex flex-wrap gap-8">
                        <div>
                            <div class="text-3xl font-black text-red-600">2.361</div>
                            <div class="text-gray-500 text-sm uppercase font-bold tracking-tighter">Total Penduduk</div>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div>
                            <div class="text-3xl font-black text-red-600">51%</div>
                            <div class="text-gray-500 text-sm uppercase font-bold tracking-tighter">Laki-Laki</div>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div>
                            <div class="text-3xl font-black text-red-600">49%</div>
                            <div class="text-gray-500 text-sm uppercase font-bold tracking-tighter">Perempuan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Grid Section - Modified for Modern Look --}}
    <section class="py-24 bg-gray-50 relative">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-4" data-aos="fade-up">Informasi Layanan <span
                    class="text-red-600">&</span> Fasilitas</h2>
            <p class="text-gray-500 mb-16 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">Fasilitas publik yang
                terus dikembangkan untuk kenyamanan seluruh warga Desa Salo Cella.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Fasilitas Kesehatan --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div
                        class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mb-8 mx-auto group-hover:bg-red-600 transition-colors">
                        <i class="fa-solid fa-heart-pulse text-2xl text-red-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-extrabold mb-4">Layanan Kesehatan</h3>
                    <ul class="text-gray-500 text-sm space-y-3">
                        <li class="flex items-center justify-center gap-2">POLINDES <span
                                class="bg-red-50 text-red-600 px-2 py-0.5 rounded-full text-[10px] font-bold">1 UNIT</span>
                        </li>
                        <li class="flex items-center justify-center gap-2">PUSBAN <span
                                class="bg-red-50 text-red-600 px-2 py-0.5 rounded-full text-[10px] font-bold">1 UNIT</span>
                        </li>
                        <li class="flex items-center justify-center gap-2">POSBINDU <span
                                class="bg-red-50 text-red-600 px-2 py-0.5 rounded-full text-[10px] font-bold">2 UNIT</span>
                        </li>
                    </ul>
                </div>

                {{-- Pendidikan --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group"
                    data-aos="zoom-in" data-aos-delay="200">
                    <div
                        class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-8 mx-auto group-hover:bg-blue-600 transition-colors">
                        <i class="fa-solid fa-graduation-cap text-2xl text-blue-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-extrabold mb-4">Pendidikan</h3>
                    <ul class="text-gray-500 text-sm space-y-3">
                        <li class="flex items-center justify-center gap-2">PAUD <span
                                class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-[10px] font-bold">3
                                UNIT</span></li>
                        <li class="flex items-center justify-center gap-2">SEKOLAH DASAR <span
                                class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-[10px] font-bold">1
                                UNIT</span></li>
                        <li class="flex items-center justify-center gap-2">SEKOLAH MENENGAH <span
                                class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full text-[10px] font-bold">1
                                UNIT</span></li>
                    </ul>
                </div>

                {{-- Peribadahan --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group"
                    data-aos="zoom-in" data-aos-delay="300">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mb-8 mx-auto group-hover:bg-green-600 transition-colors">
                        <i class="fa-solid fa-mosque text-2xl text-green-600 group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-extrabold mb-4">Peribadahan</h3>
                    <ul class="text-gray-500 text-sm space-y-3">
                        <li class="flex items-center justify-center gap-2">MOSQUE/MUSHOLLA <span
                                class="bg-green-50 text-green-600 px-2 py-0.5 rounded-full text-[10px] font-bold">10
                                UNIT</span></li>
                        <li class="text-xs italic pt-4">Mendukung Kehidupan Beragama yang Harmonis</li>
                    </ul>
                </div>

                {{-- Peta Lokasi (Special Action Card) --}}
                <div class="bg-red-600 p-8 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 text-white relative overflow-hidden"
                    data-aos="zoom-in" data-aos-delay="400">
                    <div class="absolute -right-10 -bottom-10 opacity-10 rotate-12 scale-150">
                        <i class="fa-solid fa-map-location-dot text-9xl"></i>
                    </div>
                    <h3 class="text-xl font-extrabold mb-4 relative z-10">Peta Lokasi</h3>
                    <p class="text-white/80 text-sm mb-8 relative z-10">Temukan posisi strategis Kantor Desa kami di Google
                        Maps untuk memudahkan kunjungan anda.</p>
                    <a href="https://maps.app.goo.gl/Kh9PLN51sDWkCuF87" target="_blank"
                        class="bg-white text-red-600 font-bold py-3 px-6 rounded-full text-xs uppercase tracking-wider hover:bg-gray-100 transition-colors relative z-10 inline-block">
                        Lihat di Maps <i class="fa-solid fa-location-dot ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- News Summary Section - NEW --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 md:px-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="text-left" data-aos="fade-right">
                    <span class="text-red-600 font-bold uppercase tracking-widest text-sm">— Kabar Terbaru</span>
                    <h2 class="text-4xl font-black text-gray-900 mt-2">Berita & Kegiatan Desa</h2>
                </div>
                <div data-aos="fade-left">
                    <a href="{{ route('berita') }}"
                        class="text-red-600 font-bold flex items-center gap-2 hover:gap-4 transition-all group">
                        Lihat Seluruh Berita <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($beritas as $item)
                    <div class="group bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500"
                        data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->url_gambar) }}" alt="{{ $item->judul_berita }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                onerror="this.src='https://placehold.co/600x400?text=News+Image'">

                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-red-600 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full shadow-lg">Warta
                                    Desa</span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-2 text-gray-400 text-xs mb-4">
                                <i class="fa-solid fa-calendar-days text-red-500/50"></i>
                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                            </div>
                            <h3
                                class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-red-600 transition-colors">
                                {{ $item->judul_berita }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ Str::limit(strip_tags($item->isi_berita), 120) }}
                            </p>
                            <a href="{{ route('berita.detail', $item->slug) }}"
                                class="inline-flex items-center gap-2 text-sm font-bold text-gray-900 group-hover:text-red-600 transition-colors">
                                Baca Selengkapnya <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA / Map Preview Section --}}
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 md:px-10">
            <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white" data-aos="fade-up">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.7820852681!2d117.34240417303133!3d-0.2441889353709371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df5e7c168b77d4b%3A0x8222e6267d6bad0c!2sKantor%20Desa%20Salo%20Cella!5e0!3m2!1sid!2sid!4v1758904548969!5m2!1sid!2sid"
                    width="100%" height="600" class="border-0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    {{-- Contact Section - Premium Horizontal --}}
    <section class="py-24 bg-gray-900 text-white relative overflow-hidden">
        {{-- Background Accents --}}
        <div class="absolute top-0 right-0 w-1/3 h-full bg-red-600/10 skew-x-12"></div>

        <div class="container mx-auto px-4 md:px-10 relative z-10">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <div class="w-full lg:w-1/3 text-left" data-aos="fade-right">
                    <h2 class="text-4xl font-black mb-6">Hubungi Kami</h2>
                    <p class="text-white/60 mb-8 leading-relaxed">
                        Kami siap melayani kebutuhan informasi dan administrasi anda. Silakan hubungi melalui saluran
                        komunikasi resmi kami atau kunjungi langsung kantor desa pada jam layanan.
                    </p>
                    <div class="flex items-center gap-4 p-6 bg-white/5 rounded-2xl border border-white/10">
                        <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <div class="text-xs uppercase font-bold text-red-500">Jam Operasional</div>
                            <div class="text-lg">Senin - Kamis: 08:00 - 15:00</div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-left">
                    {{-- Social Cards --}}
                    <a href="mailto:desasallocella@gmail.com"
                        class="group bg-white/5 p-8 rounded-3xl border border-white/10 hover:bg-white hover:text-gray-900 transition-all duration-500">
                        <i
                            class="fa-solid fa-envelope text-red-500 text-3xl mb-6 group-hover:scale-110 transition-transform"></i>
                        <h4 class="font-bold text-xl mb-2">Email Resmi</h4>
                        <p class="text-white/40 group-hover:text-gray-600">desasallocella@gmail.com</p>
                    </a>

                    <a href="https://www.instagram.com/desasalocella" target="_blank"
                        class="group bg-white/5 p-8 rounded-3xl border border-white/10 hover:bg-white hover:text-gray-900 transition-all duration-500">
                        <i
                            class="fa-brands fa-instagram text-pink-500 text-3xl mb-6 group-hover:scale-110 transition-transform"></i>
                        <h4 class="font-bold text-xl mb-2">Instagram</h4>
                        <p class="text-white/40 group-hover:text-gray-600">@desasallocella</p>
                    </a>

                    <a href="https://www.facebook.com/profile.php?id=100089583949440" target="_blank"
                        class="group bg-white/5 p-8 rounded-3xl border border-white/10 hover:bg-white hover:text-gray-900 transition-all duration-500">
                        <i
                            class="fa-brands fa-facebook text-blue-500 text-3xl mb-6 group-hover:scale-110 transition-transform"></i>
                        <h4 class="font-bold text-xl mb-2">Facebook</h4>
                        <p class="text-white/40 group-hover:text-gray-600">Desa Salo Cella</p>
                    </a>

                    <a href="https://www.youtube.com/@salocellatvofficial2567" target="_blank"
                        class="group bg-white/5 p-8 rounded-3xl border border-white/10 hover:bg-white hover:text-gray-900 transition-all duration-500">
                        <i
                            class="fa-brands fa-youtube text-red-600 text-3xl mb-6 group-hover:scale-110 transition-transform"></i>
                        <h4 class="font-bold text-xl mb-2">YouTube Channel</h4>
                        <p class="text-white/40 group-hover:text-gray-600">SALOCELLA TV OFFICIAL</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection