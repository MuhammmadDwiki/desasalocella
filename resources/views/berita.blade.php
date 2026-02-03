@extends('layouts.app')

@section('title', 'Berita - Desa Sallo Cela')

@section('head')
    @vite('resources/js/app.jsx')
@endsection

@section('content')
    <section class="container mt-28 mx-auto px-4 min-h-screen">
        <div class="ms-5 mt-2 p-2 ">
            <h1 class="text-4xl capitalize font-extrabold text-red-500">Berita desa</h1>
            <p class="mt-2">Menyajikan informasi terbaru tentang peristiwa, kegiatan, berita terkini, dan
                artikel-artikel jurnalistik dari desa sallo cela</p>
        </div>

        {{-- Galeri Berita --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach ($berita as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">

                    <a href="{{ 'berita/' . $item->slug }}">
                        {{-- <img src="{{ asset('' . $item->url_gambar) }}" alt="{{ $item->judul_berita }}" --}} <img
                            src="{{ asset('storage/' . $item->url_gambar) }}" alt="{{ $item->judul_berita }}"
                            class="w-full h-52 object-fill">

                        <div class="p-4 px-8">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2">
                                    <img src="{{ asset('images/icon/date.svg') }}" alt="" srcset="" class="w-4 h-4 text-gray-500
                                                             ">
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <img src="{{ asset('images/icon/person.svg') }}" alt="" srcset="" class="w-4 text-gray-500
                                                                                        ">
                                    <span class="text-xs text-gray-500">{{$item->username}}</span>
                                </div>
                            </div>
                            <h2 class="text-xl font-bold mt-2">{{ $item->judul_berita }}</h2>
                            <div class="text-gray-600 mb-4 line-clamp-3 text-sm mt-2">
                                {!! $item->isi_berita !!}
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach


        </div>
        {{-- Tombol Load More --}}
        @if (count($berita) > 0)
        
        <div class="flex justify-center mt-12 mb-8">
            <button id="loadMoreBtn"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                Load More
            </button>
        </div>
        @endif

    </section>
    </di>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const beritaContainer = document.getElementById('beritaContainer');
            const loadingSpinner = document.getElementById('loadingSpinner');

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function () {
                    const page = this.getAttribute('data-page');
                    loadMoreBerita(page);
                });
            }

            function loadMoreBerita(page) {
                // Show loading spinner
                if (loadMoreBtn) loadMoreBtn.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');

                // AJAX request
                fetch(`/berita/load-more?page=${page}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Append new berita to container
                        if (data.html) {
                            beritaContainer.insertAdjacentHTML('beforeend', data.html);
                        }

                        // Update page number for next load
                        if (loadMoreBtn && data.hasMore) {
                            loadMoreBtn.setAttribute('data-page', parseInt(page) + 1);
                            loadMoreBtn.classList.remove('hidden');
                        } else {
                            // Remove load more button if no more pages
                            if (loadMoreBtn) loadMoreBtn.remove();
                        }

                        // Hide loading spinner
                        loadingSpinner.classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error loading more berita:', error);
                        loadingSpinner.classList.add('hidden');
                        if (loadMoreBtn) loadMoreBtn.classList.remove('hidden');

                        // Show error message
                        alert('Terjadi kesalahan saat memuat berita. Silakan coba lagi.');
                    });
            }
        });
    </script>
@endpush