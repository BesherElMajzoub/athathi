<?php

namespace App\Http\Controllers;

use App\Services\ContentTemplateService;
use App\Services\SchemaService;
use App\Services\SeoMetaService;

class ServiceController extends Controller
{
    /**
     * Services index page.
     */
    public function index(SeoMetaService $seo, SchemaService $schema)
    {
        $seo->forServicesIndex();
        $services = config('business.services');

        $breadcrumbs = $schema->breadcrumbs([
            ['name' => 'الرئيسية', 'url' => url('/')],
            ['name' => 'خدماتنا', 'url' => url('/services')],
        ]);

        return view('pages.services.index', compact('seo', 'schema', 'breadcrumbs', 'services'));
    }

    /**
     * Individual service page.
     */
    public function show(string $slug, SeoMetaService $seo, SchemaService $schema, ContentTemplateService $contentService)
    {
        $services = config('business.services');
        $service = collect($services)->firstWhere('slug', $slug);

        if (!$service) {
            abort(404);
        }

        $seo->forService($service);
        $content = $contentService->generateServiceContent($service);

        // Service-specific FAQs
        $faqs = $this->getServiceFaqs($service);

        $schemas = [
            $schema->service($service),
            $schema->faqPage($faqs),
        ];

        $breadcrumbs = $schema->breadcrumbs([
            ['name' => 'الرئيسية', 'url' => url('/')],
            ['name' => 'خدماتنا', 'url' => url('/services')],
            ['name' => $service['title_ar']],
        ]);

        $otherServices = collect($services)->where('slug', '!=', $slug)->values()->all();

        return view('pages.services.show', compact(
            'seo', 'schema', 'schemas', 'breadcrumbs', 'service', 'content', 'faqs', 'otherServices'
        ));
    }

    /**
     * Get FAQs specific to a service.
     */
    protected function getServiceFaqs(array $service): array
    {
        $title = $service['title_ar'];
        $city = config('business.city_ar');
        $phone = config('business.phone');

        return [
            [
                'question' => "ما هي تكلفة خدمة {$title}؟",
                'answer' => "تكلفة الخدمة تعتمد على نوع وحالة القطع المراد شراؤها. نحن نقدم أعلى الأسعار في {$city} مع معاينة مجانية. اتصل بنا على {$phone} للحصول على تقييم فوري.",
            ],
            [
                'question' => "هل تقدمون خدمة الفك والنقل مع {$title}؟",
                'answer' => "نعم، جميع خدماتنا تشمل الفك والنقل المجاني. فريقنا المحترف يتولى كل شيء من الفك حتى التحميل والنقل.",
            ],
            [
                'question' => "كيف أحصل على أفضل سعر في خدمة {$title}؟",
                'answer' => "للحصول على أفضل سعر، تأكد من نظافة القطع وسلامتها. القطع ذات الحالة الجيدة والماركات المعروفة تحصل على أعلى التقييمات. كما أن بيع مجموعات كاملة يمنحك سعراً أفضل.",
            ],
            [
                'question' => "هل تخدمون جميع أحياء {$city} في خدمة {$title}؟",
                'answer' => "نعم، نقدم خدمة {$title} في جميع أحياء ومناطق {$city}. نصل لك في أي موقع خلال 30 دقيقة أو أقل.",
            ],
            [
                'question' => "ما هي ساعات العمل لخدمة {$title}؟",
                'answer' => "نعمل على مدار الساعة 24/7 طوال أيام الأسبوع بما في ذلك العطل والأعياد. يمكنك الاتصال بنا في أي وقت.",
            ],
            [
                'question' => "كيف يتم الدفع في خدمة {$title}؟",
                'answer' => "يتم الدفع نقدياً فور الاتفاق على السعر مباشرة في موقعك. لا حاجة لانتظار تحويلات أو مواعيد لاحقة.",
            ],
            [
                'question' => "هل يمكنكم شراء قطعة واحدة فقط من خلال {$title}؟",
                'answer' => "بالتأكيد، نشتري القطعة الواحدة والمجموعات الكاملة. مهما كان عدد القطع المراد بيعها، نرحب بخدمتك.",
            ],
            [
                'question' => "ما الذي يميزكم عن غيركم في {$title}؟",
                'answer' => "نتميز بسرعة الوصول وأعلى الأسعار والتعامل الاحترافي والدفع الفوري والفك والنقل المجاني. كما أن سنوات خبرتنا الطويلة في {$city} تضمن لك أفضل خدمة.",
            ],
        ];
    }
}
