<?php

namespace App\Services;

/**
 * Schema.org Structured Data Generator
 *
 * Generates JSON-LD markup for LocalBusiness, Service, FAQPage,
 * BreadcrumbList, and other structured data types.
 */
class SchemaService
{
    /**
     * Generate LocalBusiness schema.
     */
    public function localBusiness(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => config('business.name_ar'),
            'description' => config('business.seo.default_description'),
            'url' => url('/'),
            'telephone' => config('business.phone_intl'),
            'email' => config('business.email'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => config('business.city_ar'),
                'addressCountry' => 'SA',
                'addressRegion' => config('business.city_ar'),
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => config('business.google_map_lat'),
                'longitude' => config('business.google_map_lng'),
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                'opens' => '00:00',
                'closes' => '23:59',
            ],
            'image' => url(config('business.seo.og_image')),
            'priceRange' => '$$',
            'areaServed' => [
                '@type' => 'City',
                'name' => config('business.city_ar'),
            ],
        ];
    }

    /**
     * Generate Service schema for a specific service.
     */
    public function service(array $service): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $service['title_ar'],
            'description' => $service['meta_description'],
            'url' => url('/services/' . $service['slug']),
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => config('business.name_ar'),
                'telephone' => config('business.phone_intl'),
            ],
            'areaServed' => [
                '@type' => 'City',
                'name' => config('business.city_ar'),
            ],
            'serviceType' => $service['title_ar'],
        ];
    }

    /**
     * Generate FAQPage schema.
     */
    public function faqPage(array $faqs): array
    {
        $mainEntity = [];

        foreach ($faqs as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['answer'],
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity,
        ];
    }

    /**
     * Generate BreadcrumbList schema.
     */
    public function breadcrumbs(array $items): array
    {
        $list = [];
        foreach ($items as $i => $item) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $item['name'],
                'item' => $item['url'] ?? null,
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $list,
        ];
    }

    /**
     * Generate WebSite schema with search action.
     */
    public function website(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('business.name_ar'),
            'url' => url('/'),
            'inLanguage' => 'ar',
        ];
    }

    /**
     * Render schema as JSON-LD script tag.
     */
    public function render(array $schema): string
    {
        return '<script type="application/ld+json">' . "\n" .
            json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) .
            "\n" . '</script>';
    }

    /**
     * Render multiple schemas.
     */
    public function renderMultiple(array $schemas): string
    {
        $html = '';
        foreach ($schemas as $schema) {
            $html .= $this->render($schema) . "\n";
        }
        return $html;
    }
}
