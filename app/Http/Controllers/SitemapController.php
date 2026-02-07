<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    /**
     * Generate main sitemap index
     *
     * @return Response
     */
    public function index(): Response
    {
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);

        $sitemap = Cache::remember('sitemap_index', $cacheDuration, function () {
            return $this->generateSitemapIndex();
        });

        return response($sitemap, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * Generate sitemap for static pages
     *
     * @return Response
     */
    public function pages(): Response
    {
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);

        $sitemap = Cache::remember('sitemap_pages', $cacheDuration, function () {
            return $this->generatePagesSitemap();
        });

        return response($sitemap, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * Generate sitemap for news/berita
     *
     * @return Response
     */
    public function news(): Response
    {
        $cacheDuration = config('seo.sitemap.cache_duration', 3600);

        $sitemap = Cache::remember('sitemap_news', $cacheDuration, function () {
            return $this->generateNewsSitemap();
        });

        return response($sitemap, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * Generate sitemap index XML
     *
     * @return string
     */
    private function generateSitemapIndex(): string
    {
        $baseUrl = config('app.url');
        $now = now()->toIso8601String();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Pages sitemap
        $xml .= '<sitemap>';
        $xml .= '<loc>' . $baseUrl . '/sitemap-pages.xml</loc>';
        $xml .= '<lastmod>' . $now . '</lastmod>';
        $xml .= '</sitemap>';

        // News sitemap
        $xml .= '<sitemap>';
        $xml .= '<loc>' . $baseUrl . '/sitemap-news.xml</loc>';
        $xml .= '<lastmod>' . $now . '</lastmod>';
        $xml .= '</sitemap>';

        $xml .= '</sitemapindex>';

        return $xml;
    }

    /**
     * Generate pages sitemap XML
     *
     * @return string
     */
    private function generatePagesSitemap(): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $xml .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // Define static pages with their priority and changefreq
        $pages = [
            ['route' => 'beranda', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['route' => 'berita', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['route' => 'visi', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['route' => 'struk', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['route' => 'dapen', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['route' => 'layanan', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['route' => 'peta', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['route' => 'bpd', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['route' => 'pkk', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['route' => 'karangtrn', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['route' => 'potensi', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['route' => 'sejarah', 'priority' => '0.7', 'changefreq' => 'yearly'],
        ];

        foreach ($pages as $page) {
            if (Route::has($page['route'])) {
                $xml .= '<url>';
                $xml .= '<loc>' . route($page['route']) . '</loc>';
                $xml .= '<lastmod>' . now()->toIso8601String() . '</lastmod>';
                $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
                $xml .= '<priority>' . $page['priority'] . '</priority>';
                $xml .= '</url>';
            }
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Generate news sitemap XML
     *
     * @return string
     */
    private function generateNewsSitemap(): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"';
        $xml .= ' xmlns:news="http://www.google.com/schemas/sitemap-news/0.9"';
        $xml .= ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // Get all published news articles
        $newsArticles = Berita::orderBy('created_at', 'desc')->get();

        foreach ($newsArticles as $article) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('berita.detail', $article->slug) . '</loc>';
            $xml .= '<lastmod>' . $article->updated_at->toIso8601String() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';

            // Add news-specific tags
            $xml .= '<news:news>';
            $xml .= '<news:publication>';
            $xml .= '<news:name>Desa Salo Cella</news:name>';
            $xml .= '<news:language>id</news:language>';
            $xml .= '</news:publication>';
            $xml .= '<news:publication_date>' . $article->created_at->toIso8601String() . '</news:publication_date>';
            $xml .= '<news:title>' . htmlspecialchars($article->judul_berita, ENT_XML1) . '</news:title>';
            $xml .= '</news:news>';

            // Add image if available
            if ($article->url_gambar) {
                $xml .= '<image:image>';
                $xml .= '<image:loc>' . asset('storage/' . $article->url_gambar) . '</image:loc>';
                $xml .= '<image:title>' . htmlspecialchars($article->judul_berita, ENT_XML1) . '</image:title>';
                $xml .= '</image:image>';
            }

            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Clear sitemap cache
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearCache()
    {
        Cache::forget('sitemap_index');
        Cache::forget('sitemap_pages');
        Cache::forget('sitemap_news');

        return response()->json(['message' => 'Sitemap cache cleared successfully']);
    }
}
