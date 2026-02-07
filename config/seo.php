<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Environment-Based SEO Control
    |--------------------------------------------------------------------------
    |
    | Automatically prevent search engine indexing for development and staging
    | environments. Only production domain will be indexed.
    |
    */

    'allowed_domains' => [
        'salocella-kukar.desa.id',  // Production domain (indexable)
        // Add other production domains here if needed
    ],

    'blocked_subdomains' => [
        'dev.salocella-kukar.desa.id',
        'staging.salocella-kukar.desa.id',
        'localhost',
        '127.0.0.1',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default SEO Meta Tags
    |--------------------------------------------------------------------------
    |
    | These are the default meta tags that will be used across the website
    | if no specific meta tags are provided for a page.
    |
    */

    'default' => [
        'title' => 'Desa Salo Cella - Portal Resmi Desa Salo Cella, Muara Badak, Kalimantan Timur',
        'description' => 'Website resmi Desa Salo Cella, Kecamatan Muara Badak, Kabupaten Kutai Kartanegara, Kalimantan Timur. Informasi layanan publik, berita desa, data penduduk, struktur organisasi, dan pembangunan desa.',
        'keywords' => 'desa salo cella, muara badak, kutai kartanegara, kalimantan timur, layanan publik desa, berita desa, data penduduk, struktur organisasi desa, pembangunan desa, pemerintah desa',
        'author' => 'Pemerintah Desa Salo Cella',
        'robots' => 'index, follow',
        'canonical' => env('APP_URL', 'http://localhost'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Organization Information
    |--------------------------------------------------------------------------
    |
    | Information about Desa Salo Cella organization for structured data
    |
    */

    'organization' => [
        'name' => 'Desa Salo Cella',
        'legal_name' => 'Pemerintah Desa Salo Cella',
        'description' => 'Pemerintah Desa Salo Cella adalah organisasi pemerintahan tingkat desa yang melayani masyarakat di wilayah Desa Salo Cella, Kecamatan Muara Badak, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur.',
        'url' => env('APP_URL', 'http://localhost'),
        'logo' => env('APP_URL', 'http://localhost') . '/images/logodesa.png',
        'email' => 'desasallocella@gmail.com',
        // 'telephone' => '+62-XXX-XXXX-XXXX', // Update dengan nomor telepon kantor desa
        'address' => [
            'street' => 'Jalan Desa Salo Cella', // Update dengan alamat lengkap
            'city' => 'Kutai Kartanegara',
            'region' => 'Kalimantan Timur',
            'postal_code' => '75382', // Update dengan kode pos yang benar
            'country' => 'ID',
        ],
        'geo' => [
            'latitude' => '-0.2441889353709371',
            'longitude' => '117.34240417303133',
        ],
        'social_media' => [
            'facebook' => 'https://www.facebook.com/profile.php?id=100089583949440',
            'instagram' => 'https://www.instagram.com/desasalocella',
            'youtube' => 'https://www.youtube.com/@salocellatvofficial2567',
        ],
        'founding_date' => '2007-05-07', // Update dengan tanggal berdiri desa yang sebenarnya
    ],

    /*
    |--------------------------------------------------------------------------
    | Open Graph Default Settings
    |--------------------------------------------------------------------------
    |
    | Default Open Graph meta tags for social media sharing
    |
    */

    'opengraph' => [
        'site_name' => 'Desa Salo Cella',
        'type' => 'website',
        'locale' => 'id_ID',
        'image' => env('APP_URL', 'http://localhost') . '/images/logodesa.png',
        'image_width' => 1200,
        'image_height' => 630,
    ],

    /*
    |--------------------------------------------------------------------------
    | Twitter Card Default Settings
    |--------------------------------------------------------------------------
    |
    | Default Twitter Card meta tags
    |
    */

    'twitter' => [
        'card' => 'summary_large_image',
        'site' => '@desasalocella', // Update jika ada akun Twitter
        'creator' => '@desasalocella',
    ],

    /*
    |--------------------------------------------------------------------------
    | Page-Specific SEO Templates
    |--------------------------------------------------------------------------
    |
    | SEO templates for specific pages
    |
    */

    'pages' => [
        'home' => [
            'title' => 'Desa Salo Cella - Portal Resmi Desa Salo Cella, Muara Badak, Kalimantan Timur',
            'description' => 'Website resmi Desa Salo Cella, Kecamatan Muara Badak, Kutai Kartanegara. Informasi layanan publik, berita desa, data penduduk, struktur organisasi, dan pembangunan desa.',
            'keywords' => 'desa salo cella, muara badak, kutai kartanegara, kalimantan timur, layanan publik, berita desa',
        ],
        'berita' => [
            'title' => 'Berita & Kegiatan - Desa Salo Cella',
            'description' => 'Berita terbaru dan kegiatan-kegiatan yang dilaksanakan di Desa Salo Cella, Muara Badak, Kutai Kartanegara.',
            'keywords' => 'berita desa, kegiatan desa, warta desa, informasi desa salo cella',
        ],
        'visi_misi' => [
            'title' => 'Visi & Misi - Desa Salo Cella',
            'description' => 'Visi, Misi, dan Tujuan Pembangunan Desa Salo Cella dalam mewujudkan masyarakat yang mandiri dan sejahtera.',
            'keywords' => 'visi misi desa, tujuan pembangunan, desa salo cella',
        ],
        'struktur' => [
            'title' => 'Struktur Organisasi - Desa Salo Cella',
            'description' => 'Struktur organisasi dan perangkat Desa Salo Cella, Kecamatan Muara Badak, Kutai Kartanegara.',
            'keywords' => 'struktur organisasi, perangkat desa, kepala desa, aparat desa',
        ],
        'data_penduduk' => [
            'title' => 'Data Penduduk - Desa Salo Cella',
            'description' => 'Statistik dan data kependudukan Desa Salo Cella meliputi jumlah penduduk, demografi, dan rekapitulasi per RT.',
            'keywords' => 'data penduduk, statistik desa, demografi, jumlah penduduk',
        ],
        'layanan' => [
            'title' => 'Layanan Publik - Desa Salo Cella',
            'description' => 'Informasi layanan publik dan administrasi kependudukan yang tersedia di Kantor Desa Salo Cella.',
            'keywords' => 'layanan publik, administrasi desa, pelayanan masyarakat',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Structured Data Settings
    |--------------------------------------------------------------------------
    |
    | Settings for Schema.org structured data
    |
    */

    'structured_data' => [
        'enable_organization' => true,
        'enable_website' => true,
        'enable_breadcrumb' => true,
        'enable_government_org' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for XML sitemap generation
    |
    */

    'sitemap' => [
        'enable' => true,
        'cache_duration' => 3600, // 1 hour in seconds
    ],

];
