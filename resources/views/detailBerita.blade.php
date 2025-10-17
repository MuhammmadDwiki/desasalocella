<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul_berita }} - Desa Sallo Cela</title>
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
    <link rel="icon" href="{{ asset('images/logodesa.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-50">
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
                        <a href="{{ route('sejarah') }}">Sejarah Desa</a>
                        <a href="{{ route('visi') }}">Visi & Misi</a>
                        <a href="{{ route('struk') }}">Perangkat Desa</a>
                        <a href="{{ route('peta') }}">Peta Administrasi</a>
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

    <div class="container mt-[8rem] mx-auto px-4 max-w-6xl">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('beranda') }}" class="inline-flex items-center text-sm text-gray-700 hover:text-red-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <a href="{{ route('berita') }}" class="ml-1 text-sm text-gray-700 hover:text-red-600 md:ml-2">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-1 text-sm text-gray-500 md:ml-2 truncate max-w-xs">{{ Str::limit($berita->judul_berita, 40) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Featured Image -->
            @if($berita->url_gambar)
            <div class="w-full h-96 overflow-hidden">
                <img 
                    src="{{ asset('storage/' . $berita->url_gambar) }}" 
                    alt="{{ $berita->judul_berita }}" 
                    class="w-full h-full object-cover"
                    onerror="this.src='https://via.placeholder.com/800x400?text=Gambar+Berita+Tidak+Tersedia'"
                >
            </div>
            @endif

            <!-- Article Content -->
            <div class="p-8">
                <!-- Article Header -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $berita->judul_berita }}
                    </h1>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('l, d F Y') }}</span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Oleh: {{ $berita->nama_lengkap ?? $berita->username ?? 'Admin Desa' }}</span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($berita->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Article Body -->
                <article class="prose prose-lg max-w-none">
                    <div class="text-gray-700 leading-relaxed text-justify">
                        {!! $berita->isi_berita !!}
                    </div>
                </article>

                <!-- Tags & Share -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <!-- Share Buttons -->
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium text-gray-700">Bagikan:</span>
                            <div class="flex gap-2">
                                <button onclick="shareFacebook()" class="p-2 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 transition duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </button>
                                <button onclick="shareTwitter()" class="p-2 bg-blue-100 text-blue-400 rounded-full hover:bg-blue-200 transition duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.016 10.016 0 01-3.127 1.184 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </button>
                                <button onclick="shareWhatsApp()" class="p-2 bg-green-100 text-green-600 rounded-full hover:bg-green-200 transition duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893-.001-3.189-1.262-6.189-3.553-8.449"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Back to News Button -->
                        <a href="{{ route('berita') }}" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related News Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h2>
            <div id="relatedNews" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Related news will be loaded here via AJAX -->
            </div>
            <div id="relatedLoading" class="flex justify-center py-8">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-red-500"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer mt-12">
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
            &copy; {{ date('Y') }} Desa Sallo Cela. All Rights Reserved.
        </div>
    </footer>

    <script>
        // Share functions
        function shareFacebook() {
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        }

        function shareTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent("{{ $berita->judul_berita }}");
            window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
        }

        function shareWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent("{{ $berita->judul_berita }}");
            window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
        }

        // Load related news
        document.addEventListener('DOMContentLoaded', function() {
            loadRelatedNews();
        });

        function loadRelatedNews() {
            const currentSlug = "{{ $berita->slug }}";
            console.log(currentSlug)
            fetch(`/berita/related/${currentSlug}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('relatedNews');
                    const loading = document.getElementById('relatedLoading');
                    
                    if (data.html) {
                        container.innerHTML = data.html;
                    } else {
                        container.innerHTML = '<p class="text-gray-500 text-center col-span-3">Tidak ada berita terkait</p>';
                    }
                    
                    loading.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error loading related news:', error);
                    document.getElementById('relatedLoading').style.display = 'none';
                    document.getElementById('relatedNews').innerHTML = '<p class="text-gray-500 text-center col-span-3">Gagal memuat berita terkait</p>';
                });
        }
    </script>

    <style>
        .prose {
            max-width: none;
        }
        .prose p {
            margin-bottom: 1.5em;
            line-height: 1.8;
        }
        .prose img {
            border-radius: 0.5rem;
            margin: 2em auto;
        }
        .prose h2 {
            font-size: 1.5em;
            font-weight: bold;
            margin-top: 2em;
            margin-bottom: 1em;
            color: #1f2937;
        }
        .prose h3 {
            font-size: 1.25em;
            font-weight: bold;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
            color: #374151;
        }
        .prose ul, .prose ol {
            margin-bottom: 1.5em;
            padding-left: 1.5em;
        }
        .prose li {
            margin-bottom: 0.5em;
        }
        .prose blockquote {
            border-left: 4px solid #ef4444;
            padding-left: 1em;
            font-style: italic;
            color: #6b7280;
            margin: 2em 0;
        }
    </style>
</body>
</html>