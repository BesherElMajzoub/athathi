<?php

namespace App\Http\Controllers;

use App\Models\DistrictPage;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML Sitemap.
     */
    public function xml(): Response
    {
        $services = config('business.services');
        $clusters = config('jeddah_districts.clusters');

        $urls = [];

        // Static pages
        $urls[] = ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'];
        $urls[] = ['loc' => url('/services'), 'priority' => '0.9', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => url('/districts'), 'priority' => '0.9', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => url('/faq'), 'priority' => '0.8', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => url('/about'), 'priority' => '0.7', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => url('/contact'), 'priority' => '0.7', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => url('/video'), 'priority' => '0.6', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => url('/sitemap'), 'priority' => '0.5', 'changefreq' => 'weekly'];

        // Service pages
        foreach ($services as $service) {
            $urls[] = [
                'loc' => url('/services/' . $service['slug']),
                'priority' => '0.9',
                'changefreq' => 'weekly',
            ];
        }

        // District clusters and neighborhoods
        foreach ($clusters as $clusterKey => $cluster) {
            $urls[] = [
                'loc' => url('/districts/' . $cluster['slug']),
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ];

            foreach ($cluster['neighborhoods'] as $neighborhood) {
                $urls[] = [
                    'loc' => url('/districts/' . $cluster['slug'] . '/' . $neighborhood['slug']),
                    'priority' => '0.7',
                    'changefreq' => 'weekly',
                ];
            }
        }

        // DB-stored district pages (if any additional ones exist)
        $dbPages = DistrictPage::published()->get();
        foreach ($dbPages as $page) {
            $url = url('/districts/' . $page->cluster_key . '/' . $page->neighborhood_slug);
            // Avoid duplicates
            if (!collect($urls)->pluck('loc')->contains($url)) {
                $urls[] = [
                    'loc' => $url,
                    'priority' => '0.7',
                    'changefreq' => 'weekly',
                ];
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
