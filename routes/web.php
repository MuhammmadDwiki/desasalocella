<?php

use App\Http\Controllers\AgamaController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BpdController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailRekapitulasiController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\KarangTarunaController;
use App\Http\Controllers\KegiatanRTController;
use App\Http\Controllers\KelompokKerjaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\PkkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapitulasiPendudukController;
use App\Http\Controllers\RekapitulasiRTController;
use App\Http\Controllers\RTController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/send-email', [EmailController::class, 'sendWelcomeEmail']);

// # AUTH
// Route::get('/verifyEmail', function(){
//     return Inertia::render('Auth/VerifyEmail');
// })->name('verify-email-page');

// # =========== ADMIN =========== ##
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('laporan-bulanan', [RekapitulasiPendudukController::class, 'index'])->middleware(['auth', 'verified'])->name('laporanBulanan');

Route::get('laporan-bulanan/{id_rekap}', [RekapitulasiPendudukController::class, 'show'])->name('laporans.show');

Route::get('/agama', [AgamaController::class, 'index'])->middleware(['auth', 'verified'])->name('agama');
Route::get('/kegiatan', [KegiatanRTController::class, 'index'])->middleware(['auth', 'verified'])->name('kegiatan');
Route::get('/karang-taruna', [KarangTarunaController::class, 'index'])->middleware(['auth', 'verified'])->name('karangTaruna');
// Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index'])->middleware(['auth', 'verified'])->name('perangkatDesa');
Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index'])->middleware(['auth', 'verified'])->name('perangkatDesa');
Route::get('/badan-permusyawaratan-desa', [BpdController::class, 'index'])->middleware(['auth', 'verified'])->name('bpd-admin');
Route::get('/pemberdayaan-kesejahteraan-keluarga', [PkkController::class, 'index'])->middleware(['auth', 'verified'])->name('pkk-admin');

Route::middleware(['auth', 'can:super_admin', 'verified'])->group(function () {
    // Route::resource('users', 'UserController'); // CRUD staff accounts
    // Route::resource('rts', 'RTController'); // CRUD data RT
    // Route::post('laporan/{laporan}/verify', 'LaporanBulananController@verify'); // Verifikasi laporan
    Route::resource('rt', RTController::class);
    Route::resource('users', UserController::class);
    Route::get('/user-account', [UserController::class, 'index'])->name('userAccount');
    Route::get('/manage-rt', [RTController::class, 'index'])->name('RTController');

    Route::post('/rekapitulasi-rt/{id_rekap_rt}/validate', [RekapitulasiRTController::class, 'validate'])->name('rekapitulasi-rt.validate');
    Route::post('/rekapitulasi-rt/{id_rekap_rt}/reject', [RekapitulasiRTController::class, 'reject'])->name('rekapitulasi-rt.reject');



});

Route::middleware(['auth', 'verified', 'can:moderator'])->group(function () {
    Route::post('/rekapitulasi-rt/{id_rekap_rt}/submit', [RekapitulasiRTController::class, 'submit'])->name('rekapitulasi-rt.submit');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('Dashboard', DashboardController::class);
    Route::resource('laporan', RekapitulasiPendudukController::class);
    Route::resource('detailLaporan', DetailRekapitulasiController::class)->except(['index']);
    Route::resource('kegiatans', KegiatanRTController::class);
    Route::resource('agamas', AgamaController::class);
    Route::resource('karangTarunas', KarangTarunaController::class);
    Route::resource('Berita', BeritaController::class);
    Route::resource('perangkatDesas', PerangkatDesaController::class);
    Route::resource('bpds', BpdController::class);
    Route::resource('pkks', PkkController::class);
    Route::resource('kelompok-kerjas', KelompokKerjaController::class);
    Route::post('/rekapitulasi-rt', [RekapitulasiRTController::class, 'store'])->name('rekapitulasi-rt.store');

    Route::post('/notifications/{id}/mark-as-read', function ($id) {
        Auth::user()         // atau auth()->user()
            ->notifications()
            ->where('read_at', null)
            ->where('id', $id)
            ->update(['read_at' => now()]);

        return back()->with('success', 'Notifikasi dibaca');
    })->middleware('auth')->name('notifications.markAsRead');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('detail-laporan/used-age-groups/{id_rt}/{id_rekap}', [DetailRekapitulasiController::class, 'getUsedAgeGroups'])->name('detail-laporan.getUsedAgeGroups');
    Route::get('detail-laporan/by-rt/{id_rekap_rt}', [DetailRekapitulasiController::class, 'getByRT'])->name('detail-laporan.by-rt');

    Route::post('kelompok-kerjas/{id}/delete-with-transfer', [KelompokKerjaController::class, 'deleteWithTransfer'])
        ->name('kelompok-kerjas.delete-with-transfer');

    Route::get('/profile', function () {
        return Inertia::render('Profile/Edit');
    })->name('profile.edit');
    Route::put('/profile/{user}', [UserController::class, 'ubahProfileInformation'])->name('updateInformation');
    Route::put('/profile/{user}/password', [UserController::class, 'ubahPassword'])->name('ubahProfilePassword');

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('/verifyEmail', function () {
        return view('auth.verifyModeration');
    })->name('verifyModeration');

});

require __DIR__ . '/auth.php';

Route::get('/', [PageController::class, 'welcome'])->name('beranda');

Route::get('/sejarah', function () {
    return view('sejarahdesa');
})->name('sejarah');

Route::get('/visi', function () {
    return view('visimisi');
})->name('visi');

Route::get('/struk', [PageController::class, 'PerangkatDesa'])->name('struk');

Route::get('/dapen', [PageController::class, 'pendudukIndex'])->name('dapen'); // [nama controller, nama function]

Route::get('/peta', function () {
    return view('petadesa');
})->name('peta');

Route::get('/bpd', [PageController::class, 'Bpd'])->name('bpd');

Route::get('/ketua', [PageController::class, 'ketuaRT'])->name('ketua');

Route::get('/linmass', function () {
    return view('linmas');
})->name('linmass');

Route::get('/pkk', [PageController::class, 'Ibupkk'])->name('pkk');

Route::get('/posy', function () {
    return view('posyandu');
})->name('posy');

Route::get('/karangtrn', [PageController::class, 'karangTaruna'])->name('karangtrn');

Route::get('/potensi', function () {
    return view('potensidesa');
})->name('potensi');

Route::get('/layanan', function () {
    return view('layananpublik');
})->name('layanan');

// Route::get('/admin', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//         'title' => 'Desa Salocella'
//     ]);
// });

Route::get('/berita', [PageController::class, 'beritaIndex'])->name('berita');
Route::get('/berita/load-more', [PageController::class, 'loadMoreBerita'])->name('berita.load-more');
Route::get('/berita/{slug}', [PageController::class, 'beritaDetail'])->name('berita.detail');
Route::get('/berita/related/{slug}', [PageController::class, 'relatedNews'])->name('berita.related');
Route::get('/cuaca', [App\Http\Controllers\WeatherController::class, '']);

// Sitemap Routes
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-pages.xml', [App\Http\Controllers\SitemapController::class, 'pages'])->name('sitemap.pages');
Route::get('/sitemap-news.xml', [App\Http\Controllers\SitemapController::class, 'news'])->name('sitemap.news');

// 3
