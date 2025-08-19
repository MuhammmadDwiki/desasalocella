<?php

use App\Http\Controllers\AgamaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapitulasiPendudukController;
use App\Http\Controllers\DetailRekapitulasiController;
use App\Http\Controllers\KarangTarunaController;
use App\Http\Controllers\KegiatanRTController;
use App\Http\Controllers\RTController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

use App\Http\Controllers\EmailController;

Route::get('/send-email', [EmailController::class, 'sendWelcomeEmail']);


## =========== ADMIN =========== ##
Route::get('/dashboard', [DashboardController::class , 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/user-account', [UserController::class, "index"])->middleware(['auth', 'verified'])->name('userAccount');

Route::get('/data-pdn', function(){
    return Inertia::render('DataPenduduk');
})->middleware(['auth', 'verified'])->name('userAccount');

Route::get('/manage-rt', [RTController::class, 'index'])->middleware(['auth', 'verified'])->name('RTController');

Route::get('laporan-bulanan', [RekapitulasiPendudukController::class, 'index'])->middleware(['auth', 'verified'])->name("laporanBulanan");

Route::get('laporan-bulanan/{id}', [DetailRekapitulasiController::class, 'index'])->middleware(['auth', 'verified'])->name("detailLaporanBulanan");

Route::get('detail-laporan/by-rt/{idLaporan}/{idRt}', [DetailRekapitulasiController::class, 'getByRT'])
    ->name('detail-laporan.by-rt');

Route::get('detail-laporan/used-age-groups/{idRekap}/{idRT}', [DetailRekapitulasiController::class, 'getUsedAgeGroups'])->name('detail-laporan.getUsedAgeGroups');

Route::get('/agama', [AgamaController::class, 'index'])->middleware(['auth', 'verified'])->name('agama');
Route::get('/kegiatan', [KegiatanRTController::class, 'index'])->middleware(['auth', 'verified'])->name('kegiatan');
Route::get('/karang-taruna', [KarangTarunaController::class, 'index'])->middleware(['auth', 'verified'])->name('karangTaruna');

Route::middleware('auth')->group(function () {
    Route::resource('Dashboard', DashboardController::class);
Route::resource('rt', RTController::class)->except(['create', 'edit']);
Route::resource('laporan', RekapitulasiPendudukController::class);
Route::resource('detailLaporan', DetailRekapitulasiController::class);
    Route::resource('kegiatans', KegiatanRTController::class);
    Route::resource('agamas', AgamaController::class);
    Route::resource('karangTarunas', KarangTarunaController::class);
    
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';





Route::get('/', function () {
    return view('welcome');
})->name('beranda');

Route::get('/sejarah', function () {
    return view('sejarahdesa');
})->name('sejarah');

Route::get('/visi', function () {
    return view('visimisi');
})->name('visi');

Route::get('/struk', function () {
    return view('strukturorganisasi');
})->name('struk');

Route::get('/dapen', [PageController::class, 'pendudukIndex'])->name('dapen'); // [nama controller, nama function]

Route::get('/peta', function () {
    return view('petadesa');
})->name('peta');

Route::get('/bpd', function () {
    return view('badanpermusyawaratandesa');
})->name('bpd');

Route::get('/ketua', function () {
    return view('ketuart');
})->name('ketua');

Route::get('/linmass', function () {
    return view('linmas');
})->name('linmass');

Route::get('/pkk', function () {
    return view('ibupkk');
})->name('pkk');

Route::get('/posy', function () {
    return view('posyandu');
})->name('posy');

Route::get('/karangtrn', function () {
    return view('karangtaruna');
})->name('karangtrn');

Route::get('/potensi', function () {
    return view('potensidesa');
})->name('potensi');

Route::get('/layanan', function () {
    return view('layananpublik');
})->name('layanan');




Route::get('/cuaca', [App\Http\Controllers\WeatherController::class, '']);


## =========== ADMIN =========== ##


