<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profilkepaladesa');
})->name('profile');

Route::get('/sejarah', function () {
    return view('sejarahdesa');
})->name('sejarah');

Route::get('/visi', function () {
    return view('visimisi');
})->name('visi');

Route::get('/struk', function () {
    return view('strukturorganisasi');
})->name('struk');

Route::get('/dapen', function () {
    return view('datapenduduk');
})->name('dapen');

Route::get('/anggaran', function () {
    return view('anggarandesa');
})->name('anggaran');

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