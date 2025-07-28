<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <link rel="stylesheet" href="datapenduduk.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h2>DATA DESA PASEKAN</h2>
<p>
    Halaman Data Desa ini berisi informasi mengenai Basis Data Desa Pasekan. 
    Data yang disajikan dalam halaman ini, yakni basis data kependudukan dan data desa lainnya 
    yang diolah secara berkelanjutan dengan menggunakan aplikasi datadesa.id.
</p>

<!-- ===== Grafik Jumlah Penduduk ===== -->
<div class="chart-container">
    <h4>Jumlah Penduduk</h4>
    <canvas id="chartPenduduk"></canvas>
</div>

<!-- ===== Grafik Jumlah KK ===== -->
<div class="chart-container">
    <h4>Jumlah KK</h4>
    <canvas id="chartKK"></canvas>
</div>

<!-- ===== Grafik Agama ===== -->
<div class="chart-container">
    <h4>Agama</h4>
    <canvas id="chartAgama"></canvas>
</div>

<script>
    // ===== Grafik Jumlah Penduduk =====
    new Chart(document.getElementById('chartPenduduk'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [49.6, 50.4],
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

    // ===== Grafik Jumlah KK =====
    new Chart(document.getElementById('chartKK'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [75.7, 24.3],
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

    // ===== Grafik Agama =====
    new Chart(document.getElementById('chartAgama'), {
        type: 'pie',
        data: {
            labels: ['Islam', 'Kristen'],
            datasets: [{
                data: [95.8, 4.2],
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
</script>

</body>
</html>
