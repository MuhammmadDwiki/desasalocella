<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Meta Tags --}}
    @php
        use App\Helpers\SeoHelper;
        $seoData = SeoHelper::generateMetaTags([
            'title' => $seo_title ?? null,
            'description' => $seo_description ?? null,
            'keywords' => $seo_keywords ?? null,
            'image' => $seo_image ?? null,
            'url' => $seo_url ?? url()->current(),
            'type' => $seo_type ?? 'website',
        ]);
    @endphp

    <title>{{ $seoData['title'] }}</title>
    <meta name="description" content="{{ $seoData['description'] }}">
    <meta name="keywords" content="{{ $seoData['keywords'] }}">
    <meta name="author" content="{{ $seoData['author'] }}">
    <meta name="robots" content="{{ $seoData['robots'] }}">
    <link rel="canonical" href="{{ $seoData['canonical'] }}">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ $seoData['og']['title'] }}">
    <meta property="og:description" content="{{ $seoData['og']['description'] }}">
    <meta property="og:type" content="{{ $seoData['og']['type'] }}">
    <meta property="og:url" content="{{ $seoData['og']['url'] }}">
    <meta property="og:image" content="{{ $seoData['og']['image'] }}">
    <meta property="og:image:width" content="{{ $seoData['og']['image_width'] }}">
    <meta property="og:image:height" content="{{ $seoData['og']['image_height'] }}">
    <meta property="og:site_name" content="{{ $seoData['og']['site_name'] }}">
    <meta property="og:locale" content="{{ $seoData['og']['locale'] }}">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="{{ $seoData['twitter']['card'] }}">
    <meta name="twitter:site" content="{{ $seoData['twitter']['site'] }}">
    <meta name="twitter:title" content="{{ $seoData['twitter']['title'] }}">
    <meta name="twitter:description" content="{{ $seoData['twitter']['description'] }}">
    <meta name="twitter:image" content="{{ $seoData['twitter']['image'] }}">

    {{-- Additional Meta Tags --}}
    <meta name="theme-color" content="#dc2626">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    {{-- Google Site Verification --}}
    <meta name="google-site-verification" content="iqzZSG6es2FYNqGkWo8wwlwE9auAFRamb5c7yfB26SM" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logodesa.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logodesa.png') }}">

    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
    {{-- Common CSS --}}
    @stack('styles')

    {{-- Google Fonts - Outfit --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- AOS - Animate On Scroll --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Structured Data (JSON-LD) --}}
    @if(config('seo.structured_data.enable_organization'))
        <script type="application/ld+json">
                {!! SeoHelper::toJsonLd(SeoHelper::generateGovernmentOrganizationSchema()) !!}
            </script>
    @endif

    @if(config('seo.structured_data.enable_website') && Route::currentRouteName() === 'beranda')
        <script type="application/ld+json">
                {!! SeoHelper::toJsonLd(SeoHelper::generateWebSiteSchema()) !!}
            </script>
    @endif

    @if(config('seo.structured_data.enable_breadcrumb'))
        @php
            $breadcrumbs = SeoHelper::getBreadcrumbsFromRoute();
        @endphp
        @if(count($breadcrumbs) > 1)
            <script type="application/ld+json">
                        {!! SeoHelper::toJsonLd(SeoHelper::generateBreadcrumbSchema($breadcrumbs)) !!}
                    </script>
        @endif
    @endif

    @stack('structured_data')
    @yield('head')
</head>

<body class="bg-gray-50 text-gray-900">
    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Common Scripts --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
        });
    </script>

    @stack('scripts')
</body>

</html>