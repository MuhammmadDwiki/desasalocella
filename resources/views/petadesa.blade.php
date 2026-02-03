@extends('layouts.app')

@section('title', 'Peta Desa - Desa Sallo Cela')

@section('content')
    <section class="py-8 px-5">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Peta Desa Sallo Cela</h2>
    </section>

    <section class="px-5 pb-8 max-w-5xl mx-auto mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Peta Administrasi Desa Salo Cella</h2>
        <img src="{{ asset('images/petadesa.png') }}" alt="Peta Administrasi Desa Sallo Cela"
            class="w-full rounded-lg shadow-md mb-4">
        <p class="text-gray-700 leading-relaxed">
            Peta Administrasi Desa Salo Cella menampilkan batas wilayah desa, sungai, jalan,
            serta pemukiman. Peta ini berguna untuk memberikan gambaran umum wilayah
            administrasi desa beserta posisi strategisnya di Kecamatan Muara Badak.
        </p>
    </section>

    <section class="px-5 pb-8 max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Peta Batas RT Desa Salo Cella</h2>
        <img src="{{ asset('images/petabatasrt.png') }}" alt="Peta Batas RT Desa Sallo Cela"
            class="w-full rounded-lg shadow-md mb-4">
        <p class="text-gray-700 leading-relaxed">
            Peta Batas RT Desa Salo Cella memperlihatkan pembagian wilayah berdasarkan
            Rukun Tetangga (RT). Peta ini menunjukkan luas wilayah masing-masing RT yang
            dapat digunakan untuk perencanaan pembangunan dan pelayanan masyarakat.
        </p>
    </section>
@endsection