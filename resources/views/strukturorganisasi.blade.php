@extends('layouts.app')

@section('title', 'Struktur Organisasi - Desa Sallo Cela')

@section('content')
<div class="min-h-screen">

    <section class="pt-28 px-5 ">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Struktur Organisasi Desa Sallo Cela</h2>
    </section>
    
    <section class="px-5 pb-8 max-w-7xl mx-auto">
        @foreach ($datas as $item)
        <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-md p-6 mb-6 gap-6">
                <img src="{{ "/storage/{$item->url_foto_profil}" }}" alt="Kepala Desa" class="w-48 h-48 object-cover rounded-lg mx-auto md:mx-0">
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-red-600 mb-4">BIODATA {{ $item->jabatan_pd }}</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li><strong class="font-semibold">Nama</strong> : {{ $item->nama_pd }}</li>
                        <li><strong class="font-semibold">Jabatan</strong> : {{ $item->jabatan_pd }}</li>
                        <li><strong class="font-semibold">Tempat/Tanggal Lahir</strong> : {{$item->tempat_tanggal_lahir_pd}}</li>
                        <li><strong class="font-semibold">Pendidikan</strong> : {{ $item->pendidikan_pd }}</li>
                        <li><strong class="font-semibold">Agama</strong> : {{ $item->agama_pd }}</li>
                        <li><strong class="font-semibold">Alamat</strong> : {{ $item->alamat_pd }}</li>
                    </ul>
                </div>
            </div>
            @endforeach
            
        </section>
    </div>
        @endsection