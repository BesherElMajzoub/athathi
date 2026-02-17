<?php

namespace App\Console\Commands;

use App\Models\DistrictPage;
use App\Services\ContentTemplateService;
use Illuminate\Console\Command;

class GenerateDistrictPages extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'content:generate-district-pages
                            {--cluster= : Generate pages for a specific cluster only}
                            {--publish : Auto-publish pages that meet minimum word count}
                            {--force : Overwrite existing pages}';

    /**
     * The console command description.
     */
    protected $description = 'Generate district pages content for Jeddah neighborhoods';

    /**
     * Execute the console command.
     */
    public function handle(ContentTemplateService $contentService): int
    {
        $clusters = config('jeddah_districts.clusters');
        $targetCluster = $this->option('cluster');
        $autoPublish = $this->option('publish');
        $force = $this->option('force');
        $minWords = 900;

        $created = 0;
        $skipped = 0;
        $failed = 0;

        foreach ($clusters as $clusterKey => $cluster) {
            if ($targetCluster && $clusterKey !== $targetCluster) {
                continue;
            }

            $this->info("Processing cluster: {$cluster['name_ar']} ({$clusterKey})");

            foreach ($cluster['neighborhoods'] as $index => $neighborhood) {
                $slug = $neighborhood['slug'];

                // Check if page already exists
                $existing = DistrictPage::where('neighborhood_slug', $slug)->first();

                if ($existing && !$force) {
                    $this->line("  ⏭ Skipping {$neighborhood['name_ar']} (already exists)");
                    $skipped++;
                    continue;
                }

                $this->line("  ⚙ Generating content for {$neighborhood['name_ar']}...");

                try {
                    // Generate content
                    $content = $contentService->generateNeighborhoodContent(
                        $neighborhood['name_ar'],
                        $cluster['name_ar'],
                        $neighborhood['landmarks'] ?? [],
                        crc32($slug) + $index
                    );

                    // Generate FAQs
                    $faqs = $contentService->generateNeighborhoodFaqs(
                        $neighborhood['name_ar']
                    );

                    // Generate meta
                    $city = config('business.city_ar');
                    $triggers = ['أعلى سعر', 'نجيك فوراً', 'دفع نقدي', 'استلام سريع'];
                    $trigger = $triggers[crc32($slug) % count($triggers)];

                    $metaTitle = "شراء اثاث مستعمل في {$neighborhood['name_ar']} {$city} | {$trigger}";
                    $metaDescription = "نشتري الأثاث المستعمل والعفش والمكيفات في {$neighborhood['name_ar']} بجدة بأعلى الأسعار. نصل لك فوراً مع خدمة فك ونقل مجانية ودفع نقدي فوري.";

                    // Calculate word count
                    $text = strip_tags($content);
                    $wordCount = count(preg_split('/\s+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY));

                    // Determine status
                    $status = 'draft';
                    if ($autoPublish && $wordCount >= $minWords) {
                        $status = 'published';
                    }

                    // Create or update
                    $data = [
                        'cluster_key' => $clusterKey,
                        'cluster_name_ar' => $cluster['name_ar'],
                        'neighborhood_name_ar' => $neighborhood['name_ar'],
                        'neighborhood_slug' => $slug,
                        'meta_title' => mb_substr($metaTitle, 0, 200),
                        'meta_description' => mb_substr($metaDescription, 0, 300),
                        'content_ar' => $content,
                        'faqs' => $faqs,
                        'landmarks' => $neighborhood['landmarks'] ?? [],
                        'status' => $status,
                        'word_count' => $wordCount,
                    ];

                    if ($existing && $force) {
                        $existing->update($data);
                        $this->line("    ✅ Updated ({$wordCount} words, {$status})");
                    } else {
                        DistrictPage::create($data);
                        $this->line("    ✅ Created ({$wordCount} words, {$status})");
                    }

                    $created++;

                    if ($wordCount < $minWords) {
                        $this->warn("    ⚠ Word count ({$wordCount}) below minimum ({$minWords})");
                    }
                } catch (\Exception $e) {
                    $this->error("    ❌ Failed: {$e->getMessage()}");
                    $failed++;
                }
            }
        }

        $this->newLine();
        $this->info("Done! Created/Updated: {$created}, Skipped: {$skipped}, Failed: {$failed}");

        return self::SUCCESS;
    }
}
