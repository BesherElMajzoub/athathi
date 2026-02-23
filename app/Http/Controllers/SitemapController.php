<?php

namespace App\Http\Controllers;

use App\Models\DistrictPage;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function xml(): Response
    {
        $services = config('business.services', []);
        $clusters = config('jeddah_districts.clusters', []);

        $urls = [];
        $seen = []; // for fast dedupe

        $add = function (string $loc, string $priority, string $changefreq, ?string $lastmod = null) use (&$urls, &$seen) {
            if (isset($seen[$loc])) {
                return;
            }
            $seen[$loc] = true;

            $urls[] = [
                'loc' => $loc,
                'priority' => $priority,
                'changefreq' => $changefreq,
                'lastmod' => $lastmod,
            ];
        };

        $today = Carbon::now()->toDateString();

        // Static pages
        $add(url('/'), '1.0', 'daily', $today);
        $add(url('/services'), '0.9', 'weekly', $today);
        $add(url('/districts'), '0.9', 'weekly', $today);
        $add(url('/faq'), '0.8', 'weekly', $today);
        $add(url('/about'), '0.7', 'monthly', $today);
        $add(url('/contact'), '0.7', 'monthly', $today);
        $add(url('/video'), '0.6', 'monthly', $today);

        // IMPORTANT: do NOT include /sitemap page itself inside sitemap.xml
        // $add(url('/sitemap'), '0.5', 'weekly', $today);

        // Service pages
        foreach ($services as $service) {
            if (! isset($service['slug'])) {
                continue;
            }
            $add(url('/services/'.$service['slug']), '0.9', 'weekly', $today);
        }

        // District clusters and neighborhoods
        foreach ($clusters as $cluster) {
            if (! isset($cluster['slug'])) {
                continue;
            }

            $add(url('/districts/'.$cluster['slug']), '0.8', 'weekly', $today);

            foreach (($cluster['neighborhoods'] ?? []) as $neighborhood) {
                if (! isset($neighborhood['slug'])) {
                    continue;
                }

                $add(
                    url('/districts/'.$cluster['slug'].'/'.$neighborhood['slug']),
                    '0.7',
                    'weekly',
                    $today
                );
            }
        }

        // DB-stored district pages
        $dbPages = DistrictPage::published()->get();
        foreach ($dbPages as $page) {
            $loc = url('/districts/'.$page->cluster_key.'/'.$page->neighborhood_slug);

            $lastmod = $page->updated_at ? Carbon::parse($page->updated_at)->toDateString() : $today;

            $add($loc, '0.7', 'weekly', $lastmod);
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.e($u['loc'])."</loc>\n";
            if (! empty($u['lastmod'])) {
                $xml .= '    <lastmod>'.$u['lastmod']."</lastmod>\n";
            }
            $xml .= '    <changefreq>'.$u['changefreq']."</changefreq>\n";
            $xml .= '    <priority>'.$u['priority']."</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>\n";

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
