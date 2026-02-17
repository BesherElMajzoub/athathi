<?php

namespace App\Http\Controllers;

use App\Services\SchemaService;
use App\Services\SeoMetaService;

class HomeController extends Controller
{
    /**
     * Home page.
     */
    public function index(SeoMetaService $seo, SchemaService $schema)
    {
        $seo->forHome();
        $services = config('business.services');

        $faqs = $this->getHomeFaqs();

        $schemas = [
            $schema->localBusiness(),
            $schema->website(),
            $schema->faqPage($faqs),
        ];

        $breadcrumbs = $schema->breadcrumbs([
            ['name' => 'الرئيسية', 'url' => url('/')],
        ]);

        return view('pages.home', compact('seo', 'schema', 'schemas', 'breadcrumbs', 'services', 'faqs'));
    }

    /**
     * Get featured FAQs for the home page.
     */
    protected function getHomeFaqs(): array
    {
        return [
            [
                'question' => 'كيف يتم تحديد سعر الأثاث المستعمل؟',
                'answer' => 'يتم تحديد السعر بناءً على حالة الأثاث ونوعه وماركته وعمره الافتراضي والطلب عليه في السوق. فريقنا المتخصص يقوم بالمعاينة الميدانية وتقديم عرض سعر عادل وشفاف.',
            ],
            [
                'question' => 'هل خدمة الفك والنقل مجانية؟',
                'answer' => 'نعم، خدمة الفك والنقل مجانية تماماً. فريقنا المحترف يتولى عملية الفك والتحميل والنقل بالكامل دون أي تكلفة إضافية عليك.',
            ],
            [
                'question' => 'ما هي أنواع الأثاث التي تشترونها؟',
                'answer' => 'نشتري جميع أنواع الأثاث المستعمل بما في ذلك غرف النوم والمجالس والصالونات والمطابخ والمكيفات والأجهزة الكهربائية والسكراب بأنواعه.',
            ],
            [
                'question' => 'كم يستغرق الوصول بعد الاتصال؟',
                'answer' => 'نصل إلى جميع أحياء جدة خلال 15-30 دقيقة من وقت اتصالك. نحن متواجدون على مدار الساعة 24/7 طوال أيام الأسبوع.',
            ],
            [
                'question' => 'هل تشترون الأثاث القديم والتالف؟',
                'answer' => 'نعم، نشتري الأثاث بمختلف حالاته بما في ذلك الأثاث القديم. حتى القطع التالفة يمكن أن يكون لها قيمة. تواصل معنا وسنقدم لك عرض سعر.',
            ],
        ];
    }
}
