<?php

namespace App\Http\Controllers;

use App\Models\DistrictPage;
use App\Services\ContentTemplateService;
use App\Services\SchemaService;
use App\Services\SeoMetaService;

class DistrictController extends Controller
{
    /**
     * Districts hub page.
     */
    public function hub(SeoMetaService $seo, SchemaService $schema)
    {
        $seo->forDistrictHub();
        $clusters = config('jeddah_districts.clusters');

        $breadcrumbs = $schema->breadcrumbs([
            ['name' => 'الرئيسية', 'url' => url('/')],
            ['name' => 'أحياء جدة', 'url' => url('/districts')],
        ]);

        $schemas = [$schema->localBusiness()];

        return view('pages.districts.hub', compact('seo', 'schema', 'schemas', 'breadcrumbs', 'clusters'));
    }

    /**
     * Cluster page (e.g., North Jeddah).
     */
    public function cluster(string $cluster, SeoMetaService $seo, SchemaService $schema, ContentTemplateService $contentService)
    {
        $clusters = config('jeddah_districts.clusters');

        if (!isset($clusters[$cluster])) {
            abort(404);
        }

        $clusterData = $clusters[$cluster];
        $seo->forCluster($clusterData);

        $breadcrumbs = $schema->breadcrumbs([
            ['name' => 'الرئيسية', 'url' => url('/')],
            ['name' => 'أحياء جدة', 'url' => url('/districts')],
            ['name' => $clusterData['name_ar']],
        ]);

        $content = $contentService->generateClusterContent(
            $clusterData['name_ar'],
            $clusterData['neighborhoods']
        );

        $schemas = [$schema->localBusiness()];

        return view('pages.districts.cluster', compact(
            'seo', 'schema', 'schemas', 'breadcrumbs', 'clusterData', 'cluster', 'content'
        ));
    }

    /**
     * Neighborhood page.
     */
    public function neighborhood(
        string $cluster,
        string $neighborhood,
        SeoMetaService $seo,
        SchemaService $schema,
        ContentTemplateService $contentService
    ) {
        $clusters = config('jeddah_districts.clusters');

        if (!isset($clusters[$cluster])) {
            abort(404);
        }

        $clusterData = $clusters[$cluster];
        $neighborhoodData = collect($clusterData['neighborhoods'])->firstWhere('slug', $neighborhood);

        if (!$neighborhoodData) {
            abort(404);
        }

        $seo->forNeighborhood(
            $neighborhoodData['name_ar'],
            $cluster,
            $neighborhood
        );

        // Check for DB-stored content first
        $dbPage = DistrictPage::published()
            ->where('neighborhood_slug', $neighborhood)
            ->first();

        if ($dbPage) {
            $content = $dbPage->content_ar;
            $faqs = $dbPage->faqs ?? [];
        } else {
            // Generate dynamic content
            $content = $contentService->generateNeighborhoodContent(
                $neighborhoodData['name_ar'],
                $clusterData['name_ar'],
                $neighborhoodData['landmarks'] ?? [],
                crc32($neighborhood)
            );
            $faqs = $contentService->generateNeighborhoodFaqs($neighborhoodData['name_ar']);
        }

        $breadcrumbs = $schema->breadcrumbs([
            ['name' => 'الرئيسية', 'url' => url('/')],
            ['name' => 'أحياء جدة', 'url' => url('/districts')],
            ['name' => $clusterData['name_ar'], 'url' => url("/districts/{$cluster}")],
            ['name' => $neighborhoodData['name_ar']],
        ]);

        // Nearby neighborhoods
        $nearby = collect($clusterData['neighborhoods'])
            ->where('slug', '!=', $neighborhood)
            ->random(min(4, count($clusterData['neighborhoods']) - 1))
            ->values()
            ->all();

        $schemas = [
            $schema->localBusiness(),
            $schema->faqPage($faqs),
        ];

        return view('pages.districts.neighborhood', compact(
            'seo', 'schema', 'schemas', 'breadcrumbs', 'clusterData', 'cluster',
            'neighborhoodData', 'content', 'faqs', 'nearby'
        ));
    }
}
