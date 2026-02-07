@extends('layouts.app')

@section('title', 'Data Penduduk - Desa Salo Cella')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/js/app.jsx')
@endsection

@section('content')
    <div class="min-h-screen">

        <section class="container mx-auto px-8">

            <section class="pt-28 px-5">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Data Penduduk Desa Salo Cella</h2>
            </section>

            <p class="text-center text-gray-600 px-5 max-w-4xl mx-auto mb-8">
                Halaman Data Desa ini berisi informasi mengenai Basis Data Desa Salo Cella.
                Data yang disajikan dalam halaman ini, yakni basis data kependudukan dan data desa lainnya
                yang diolah secara berkelanjutan.
            </p>

            {{-- ===== Grafik Jumlah Penduduk ===== --}}
            <div class='grid grid-cols-1 md:grid-cols-2 container mx-auto gap-6 px-5 mb-8'>

                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center">
                    <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">Jumlah Penduduk</h4>
                    <canvas id="chartPenduduk"></canvas>
                </div>

                {{-- ===== Grafik Jumlah KK ===== --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">Jumlah KK</h4>
                    <div class="flex flex-col items-center justify-center py-8">
                        <p class="text-6xl font-bold text-blue-600">{{ $penduduk['jumlah_kk'] }}</p>
                        <p class="text-gray-500 font-medium mt-2">Kepala Keluarga</p>
                    </div>
                </div>

                {{-- ===== Grafik Agama ===== --}}
                <!-- <div class="bg-white rounded-lg shadow-md p-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4 text-center">Agama</h4>
                    <canvas id="chartAgama"></canvas>
                </div> -->
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        const penduduk = @json($penduduk);
        // Hitung persentase
        const total = penduduk.totalLaki + penduduk.totalPerempuan;

        const persenLaki = ((penduduk.totalLaki / total) * 100).toFixed(1);
        const persenPerempuan = ((penduduk.totalPerempuan / total) * 100).toFixed(1);
        // console.log(penduduk)
        const kk = penduduk.jumlah_kk;

        // ===== Grafik Jumlah Penduduk =====
        new Chart(document.getElementById('chartPenduduk'), {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [persenLaki, persenPerempuan],
                    backgroundColor: ['#1E56E7', '#E23B0F']
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'right' },
                    tooltip: {
                        callbacks: { label: ctx => ctx.label + ': ' + ctx.parsed + '%' }
                    }
                }
            }
        });


        // ===== Chart KK =====
        // const ctxKK = document.getElementById('chartKK').getContext('2d');
        // new Chart(ctxKK, {
        //     type: 'bar',
        //     data: {
        //         labels: kk.map(k => k.rt),
        //         datasets: [{
        //             label: 'Jumlah KK',
        //             data: kk.map(k => k.total),
        //             backgroundColor: 'rgba(59, 130, 246, 0.7)',
        //             borderColor: 'rgba(59, 130, 246, 1)',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: true,
        //         plugins: {
        //             legend: {
        //                 display: true,
        //                 position: 'top'
        //             }
        //         },
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // ===== Chart Agama =====
        // const ctxAgama = document.getElementById('chartAgama').getContext('2d');
        // new Chart(ctxAgama, {
        //     type: 'pie',
        //     data: {
        //         labels: agama.map(a => a.agama),
        //         datasets: [{
        //             label: 'Agama',
        //             data: agama.map(a => a.total),
        //             backgroundColor: [
        //                 'rgba(220, 38, 38, 0.7)',
        //                 'rgba(59, 130, 246, 0.7)',
        //                 'rgba(16, 185, 129, 0.7)',
        //                 'rgba(245, 158, 11, 0.7)',
        //                 'rgba(139, 92, 246, 0.7)'
        //             ],
        //             borderColor: [
        //                 'rgba(220, 38, 38, 1)',
        //                 'rgba(59, 130, 246, 1)',
        //                 'rgba(16, 185, 129, 1)',
        //                 'rgba(245, 158, 11, 1)',
        //                 'rgba(139, 92, 246, 1)'
        //             ],
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: true,
        //         plugins: {
        //             legend: {
        //                 display: true,
        //                 position: 'bottom'
        //             }
        //         }
        //     }
        // });
    </script>
@endpush