@extends('layouts.app')

@section('title', 'Karang Taruna - Desa Sallo Cela')

@section('content')
    <div class="min-h-screen">

        <section class="pt-28 px-5">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Karang Taruna Desa Salo Cella</h2>
        </section>

        <section class="px-5 pb-8 max-w-5xl mx-auto">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-3 text-center w-16">No</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Nama</th>
                            <th class="border border-gray-300 px-4 py-3 text-left">Status Dalam Organisasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($datas->isEmpty())
                            <tr>
                                <td colspan="3" class="border border-gray-300 px-4 py-14 text-center text-gray-500">Data Kosong
                                </td>
                            </tr>

                        @endif
                        @foreach ($datas as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->nama_anggota }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->jabatan }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </section>
    </div>
@endsection