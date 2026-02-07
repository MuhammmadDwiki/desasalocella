<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class SeoHelper
{
    /**
     * Check if current domain should be indexed by search engines
     *
     * @return bool
     */
    public static function shouldIndex(): bool
    {
        $currentUrl = url('/');
        $currentDomain = parse_url($currentUrl, PHP_URL_HOST);

        // Check if domain is in blocked list
        $blockedDomains = config('seo.blocked_subdomains', []);
        if (in_array($currentDomain, $blockedDomains)) {
            return false;
        }

        // Check if domain is in allowed list
        $allowedDomains = config('seo.allowed_domains', []);
        if (count($allowedDomains) > 0) {
            return in_array($currentDomain, $allowedDomains);
        }

        // Default: block if environment is not production
        return app()->environment('production');
    }

    /**
     * Get robots meta tag value based on environment
     *
     * @return string
     */
    public static function getRobotsDirective(): string
    {
        if (!self::shouldIndex()) {
            return 'noindex, nofollow';
        }

        return config('seo.default.robots', 'index, follow');
    }

    /**
     * Generate SEO meta tags for a page
     *
     * @param array $customData
     * @return array
     */
    public static function generateMetaTags(array $customData = []): array
    {
        $defaults = config('seo.default');
        $ogDefaults = config('seo.opengraph');
        $twitterDefaults = config('seo.twitter');

        $title = $customData['title'] ?? $defaults['title'];
        $description = $customData['description'] ?? $defaults['description'];
        $keywords = $customData['keywords'] ?? $defaults['keywords'];
        $image = $customData['image'] ?? $ogDefaults['image'];
        $url = $customData['url'] ?? url()->current();
        $type = $customData['type'] ?? $ogDefaults['type'];

        // Automatically set robots directive based on environment
        $robots = self::getRobotsDirective();

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => $url,
            'robots' => $robots,
            'author' => $defaults['author'],

            // Open Graph
            'og' => [
                'title' => $customData['og_title'] ?? $title,
                'description' => $customData['og_description'] ?? $description,
                'type' => $type,
                'url' => $url,
                'image' => $image,
                'image_width' => $customData['image_width'] ?? $ogDefaults['image_width'],
                'image_height' => $customData['image_height'] ?? $ogDefaults['image_height'],
                'site_name' => $ogDefaults['site_name'],
                'locale' => $ogDefaults['locale'],
            ],

            // Twitter Card
            'twitter' => [
                'card' => $twitterDefaults['card'],
                'site' => $twitterDefaults['site'],
                'title' => $customData['twitter_title'] ?? $title,
                'description' => $customData['twitter_description'] ?? $description,
                'image' => $image,
            ],
        ];
    }

    /**
     * Generate Organization structured data (Schema.org)
     *
     * @return array
     */
    public static function generateOrganizationSchema(): array
    {
        $org = config('seo.organization');
        $address = $org['address'];
        $geo = $org['geo'];
        $social = $org['social_media'];

        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => $org['url'] . '#organization',
            'name' => $org['name'],
            'legalName' => $org['legal_name'],
            'url' => $org['url'],
            'logo' => [
                '@type' => 'ImageObject',
                'url' => $org['logo'],
            ],
            'description' => $org['description'],
            'email' => $org['email'],
            // 'telephone' => $org['telephone'],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $address['street'],
                'addressLocality' => $address['city'],
                'addressRegion' => $address['region'],
                'postalCode' => $address['postal_code'],
                'addressCountry' => $address['country'],
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $geo['latitude'],
                'longitude' => $geo['longitude'],
            ],
            'sameAs' => array_values($social),
            'foundingDate' => $org['founding_date'],
        ];
    }

    /**
     * Generate GovernmentOrganization structured data
     *
     * @return array
     */
    public static function generateGovernmentOrganizationSchema(): array
    {
        $baseOrg = self::generateOrganizationSchema();
        $baseOrg['@type'] = 'GovernmentOrganization';

        return $baseOrg;
    }

    /**
     * Generate WebSite structured data with search action
     *
     * @return array
     */
    public static function generateWebSiteSchema(): array
    {
        $org = config('seo.organization');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $org['url'] . '#website',
            'url' => $org['url'],
            'name' => $org['name'],
            'description' => $org['description'],
            'publisher' => [
                '@id' => $org['url'] . '#organization',
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $org['url'] . '/berita?search={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
            'inLanguage' => 'id-ID',
        ];
    }

    /**
     * Generate BreadcrumbList structured data
     *
     * @param array $breadcrumbs [['name' => 'Home', 'url' => 'https://...'], ...]
     * @return array
     */
    public static function generateBreadcrumbSchema(array $breadcrumbs): array
    {
        $items = [];

        foreach ($breadcrumbs as $index => $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $crumb['name'],
                'item' => $crumb['url'] ?? null,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    /**
     * Generate NewsArticle structured data
     *
     * @param object $article
     * @return array
     */
    public static function generateNewsArticleSchema($article): array
    {
        $org = config('seo.organization');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $article->judul_berita,
            'description' => Str::limit(strip_tags($article->isi_berita), 150),
            'image' => [
                '@type' => 'ImageObject',
                'url' => asset('storage/' . $article->url_gambar),
                'width' => 1200,
                'height' => 630,
            ],
            'datePublished' => $article->created_at->toIso8601String(),
            'dateModified' => $article->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Organization',
                'name' => $org['name'],
                'url' => $org['url'],
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $org['name'],
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => $org['logo'],
                ],
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('berita.detail', $article->slug),
            ],
            'articleSection' => 'Berita Desa',
            'inLanguage' => 'id-ID',
        ];
    }

    /**
     * Generate WebPage structured data
     *
     * @param string $title
     * @param string $description
     * @param string $url
     * @return array
     */
    public static function generateWebPageSchema(string $title, string $description, string $url): array
    {
        $org = config('seo.organization');

        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $title,
            'description' => $description,
            'url' => $url,
            'publisher' => [
                '@id' => $org['url'] . '#organization',
            ],
            'inLanguage' => 'id-ID',
        ];
    }

    /**
     * Get breadcrumbs from current route
     *
     * @return array
     */
    public static function getBreadcrumbsFromRoute(): array
    {
        $routeName = Route::currentRouteName();
        $breadcrumbs = [
            ['name' => 'Beranda', 'url' => route('beranda')],
        ];

        $routes = [
            'berita' => ['name' => 'Berita & Kegiatan', 'url' => route('berita')],
            'berita.detail' => ['name' => 'Detail Berita', 'url' => null],
            'visi' => ['name' => 'Visi & Misi', 'url' => route('visi')],
            'struk' => ['name' => 'Struktur Organisasi', 'url' => route('struk')],
            'dapen' => ['name' => 'Data Penduduk', 'url' => route('dapen')],
            'layanan' => ['name' => 'Layanan Publik', 'url' => route('layanan')],
            'peta' => ['name' => 'Peta Desa', 'url' => route('peta')],
            'bpd' => ['name' => 'BPD', 'url' => route('bpd')],
            'pkk' => ['name' => 'PKK', 'url' => route('pkk')],
            'karangtrn' => ['name' => 'Karang Taruna', 'url' => route('karangtrn')],
            'potensi' => ['name' => 'Potensi Desa', 'url' => route('potensi')],
        ];

        if (isset($routes[$routeName])) {
            $breadcrumbs[] = $routes[$routeName];
        }

        return $breadcrumbs;
    }

    /**
     * Encode structured data to JSON-LD
     *
     * @param array $data
     * @return string
     */
    public static function toJsonLd(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * Get SEO data for a specific page
     *
     * @param string $pageKey
     * @return array
     */
    public static function getPageSeo(string $pageKey): array
    {
        $pages = config('seo.pages');

        if (isset($pages[$pageKey])) {
            return $pages[$pageKey];
        }

        return config('seo.default');
    }
}
