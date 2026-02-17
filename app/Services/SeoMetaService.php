<?php

namespace App\Services;

/**
 * Dynamic SEO Meta Generator Service
 *
 * Generates CTR-optimized meta titles, descriptions, canonical URLs,
 * Open Graph tags, and Twitter Cards for all page types.
 */
class SeoMetaService
{
    protected string $title = '';
    protected string $description = '';
    protected string $canonical = '';
    protected string $ogImage = '';
    protected string $pageType = 'website';
    protected array $alternates = [];
    protected string $robots = 'index, follow';

    /**
     * Generate meta for the home page.
     */
    public function forHome(): self
    {
        $this->title = config('business.seo.default_title');
        $this->description = config('business.seo.default_description');
        $this->canonical = url('/');
        $this->ogImage = url(config('business.seo.og_image'));
        $this->pageType = 'website';

        return $this;
    }

    /**
     * Generate meta for a service page.
     */
    public function forService(array $service): self
    {
        $this->title = $service['meta_title'];
        $this->description = $service['meta_description'];
        $this->canonical = url('/services/' . $service['slug']);
        $this->ogImage = url($service['image'] ?? config('business.seo.og_image'));
        $this->pageType = 'article';

        return $this;
    }

    /**
     * Generate meta for the services index page.
     */
    public function forServicesIndex(): self
    {
        $this->title = 'خدماتنا في شراء الأثاث المستعمل بجدة | أعلى الأسعار + استلام فوري';
        $this->description = 'تعرف على جميع خدماتنا في شراء الأثاث المستعمل والعفش والمكيفات والسكراب والمطابخ في جدة. نقدم أعلى الأسعار مع خدمة فك ونقل مجانية.';
        $this->canonical = url('/services');
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for the district hub page.
     */
    public function forDistrictHub(): self
    {
        $this->title = config('jeddah_districts.hub_meta_title');
        $this->description = config('jeddah_districts.hub_meta_description');
        $this->canonical = url('/districts');
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for a cluster page.
     */
    public function forCluster(array $cluster): self
    {
        $this->title = $cluster['meta_title'];
        $this->description = $cluster['meta_description'];
        $this->canonical = url('/districts/' . $cluster['slug']);
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for a neighborhood page.
     */
    public function forNeighborhood(string $neighborhoodName, string $clusterSlug, string $neighborhoodSlug): self
    {
        $city = config('business.city_ar');
        $triggers = ['أعلى سعر', 'نجيك فوراً', 'دفع نقدي', 'استلام سريع'];
        $trigger = $triggers[crc32($neighborhoodSlug) % count($triggers)];

        $this->title = "شراء اثاث مستعمل في {$neighborhoodName} {$city} | {$trigger}";
        $this->description = "نشتري الأثاث المستعمل والعفش والمكيفات في {$neighborhoodName} بجدة بأعلى الأسعار. نصل لك فوراً مع خدمة فك ونقل مجانية ودفع نقدي فوري. اتصل الآن!";
        $this->canonical = url("/districts/{$clusterSlug}/{$neighborhoodSlug}");
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for the FAQ page.
     */
    public function forFaq(): self
    {
        $this->title = 'الأسئلة الشائعة عن شراء الأثاث المستعمل بجدة | إجابات شاملة';
        $this->description = 'إجابات على أكثر الأسئلة شيوعاً حول شراء الأثاث المستعمل والعفش والمكيفات في جدة. اعرف كيف نحدد السعر وكيف تتم عملية الشراء والاستلام.';
        $this->canonical = url('/faq');
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for the about page.
     */
    public function forAbout(): self
    {
        $this->title = 'من نحن | أفضل شركة شراء أثاث مستعمل في جدة';
        $this->description = 'تعرف على قصتنا وخبرتنا الطويلة في مجال شراء الأثاث المستعمل بجدة. سنوات من الثقة والتميز في خدمة عملائنا في جميع أحياء جدة.';
        $this->canonical = url('/about');
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for the contact page.
     */
    public function forContact(): self
    {
        $this->title = 'اتصل بنا | شراء اثاث مستعمل بجدة - نجيك فوراً';
        $this->description = 'تواصل معنا الآن لشراء الأثاث المستعمل في جدة. اتصل أو أرسل واتساب وسنصل لك فوراً. خدمة على مدار الساعة في جميع أحياء جدة.';
        $this->canonical = url('/contact');
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for the video page.
     */
    public function forVideo(): self
    {
        $this->title = 'فيديو شراء اثاث مستعمل بجدة | شاهد كيف نعمل';
        $this->description = 'شاهد فيديو توضيحي عن خدمة شراء الأثاث المستعمل في جدة. تعرف على طريقة عملنا في المعاينة والتقييم والاستلام والدفع.';
        $this->canonical = url('/video');
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Generate meta for the HTML sitemap.
     */
    public function forSitemap(): self
    {
        $this->title = 'خريطة الموقع | شراء اثاث مستعمل بجدة';
        $this->description = 'تصفح جميع صفحات موقعنا: خدمات شراء الأثاث المستعمل، أحياء جدة، الأسئلة الشائعة، وطرق التواصل.';
        $this->canonical = url('/sitemap');
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Set custom meta.
     */
    public function custom(string $title, string $description, string $canonical = ''): self
    {
        $this->title = $title;
        $this->description = $description;
        $this->canonical = $canonical ?: url(request()->path());
        $this->ogImage = url(config('business.seo.og_image'));

        return $this;
    }

    /**
     * Set robots directive.
     */
    public function setRobots(string $robots): self
    {
        $this->robots = $robots;
        return $this;
    }

    /**
     * Get title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get description.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get canonical URL.
     */
    public function getCanonical(): string
    {
        return $this->canonical;
    }

    /**
     * Render all meta tags as HTML.
     */
    public function render(): string
    {
        $locale = config('business.seo.locale', 'ar_SA');
        $siteName = config('business.name_ar');

        $html = '';
        $html .= '<title>' . e($this->title) . '</title>' . "\n";
        $html .= '<meta name="description" content="' . e($this->description) . '">' . "\n";
        $html .= '<meta name="robots" content="' . e($this->robots) . '">' . "\n";
        $html .= '<link rel="canonical" href="' . e($this->canonical) . '">' . "\n";

        // Open Graph
        $html .= '<meta property="og:type" content="' . e($this->pageType) . '">' . "\n";
        $html .= '<meta property="og:title" content="' . e($this->title) . '">' . "\n";
        $html .= '<meta property="og:description" content="' . e($this->description) . '">' . "\n";
        $html .= '<meta property="og:url" content="' . e($this->canonical) . '">' . "\n";
        $html .= '<meta property="og:image" content="' . e($this->ogImage) . '">' . "\n";
        $html .= '<meta property="og:locale" content="' . e($locale) . '">' . "\n";
        $html .= '<meta property="og:site_name" content="' . e($siteName) . '">' . "\n";

        // Twitter Cards
        $html .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
        $html .= '<meta name="twitter:title" content="' . e($this->title) . '">' . "\n";
        $html .= '<meta name="twitter:description" content="' . e($this->description) . '">' . "\n";
        $html .= '<meta name="twitter:image" content="' . e($this->ogImage) . '">' . "\n";

        return $html;
    }
}
