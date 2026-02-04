@extends('layouts.app')

@section('title', 'PKK - Desa Salo Cella')

@section('content')
    <div class="min-h-screen">

        <section class="pt-28 px-5">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Data PKK Desa Salo Cella</h2>
        </section>

        <section class="px-5 pb-8 max-w-6xl mx-auto space-y-6">
            {{-- Tabel Pengurus --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-3 text-center w-16">No</th>
                            <th class="border border-gray-300 px-4 py-3 text-left w-40">Jabatan</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas_inti as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->jabatan_pkk }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->nama_pkk }}</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-3 text-center w-16">No</th>
                            @foreach ($datas_pokja as $kelompok_kerja => $anggota_collection)
                                <th class="border border-gray-300 px-4 py-3 text-center">{{ $kelompok_kerja }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $max_rows; $i++)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $i + 1 }}</td>

                                @foreach ($datas_pokja as $kelompok_kerja => $anggota_collection)
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        @if (isset($anggota_collection[$i]))
                                            {{-- Tampilkan Nama dan Jabatan --}}
                                            {{ $anggota_collection[$i]->nama_pkk }} ({{ $anggota_collection[$i]->jabatan_pkk }})
                                        @else
                                            {{-- Kosongkan jika data pada index $i tidak ada di Pokja ini --}}
                                            &nbsp;
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </section>
    </div>

@endsection