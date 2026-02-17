@extends('layouts.app')

@section('content')
    <section class="section page-header-section">
        <div class="container">
            <h1>الأسئلة الشائعة عن شراء الأثاث المستعمل بجدة</h1>
            <p class="page-intro">
                إليك إجابات شاملة على أكثر الأسئلة شيوعاً حول خدمة شراء الأثاث المستعمل والعفش والمكيفات في جدة.
                نجيب على استفساراتكم حول طريقة التسعير والدفع والفك والنقل ومناطق الخدمة.
            </p>
        </div>
    </section>

    <section class="section faq-page-section">
        <div class="container">
            <div class="content-layout">
                <div class="content-main">
                    @include('components.faq-accordion', ['faqs' => $faqs])
                </div>

                <aside class="content-sidebar">
                    <div class="sidebar-card sidebar-contact">
                        <h3>لم تجد إجابتك؟</h3>
                        <p>تواصل معنا مباشرة وسنجيب على جميع استفساراتك</p>
                        <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-block"
                            data-track="faq-sidebar-call">📞 {{ config('business.phone') }}</a>
                        <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-block" target="_blank"
                            rel="noopener" data-track="faq-sidebar-whatsapp">💬 واتساب</a>
                    </div>

                    <div class="sidebar-card">
                        <h3>خدماتنا</h3>
                        <ul class="sidebar-links">
                            @foreach (config('business.services') as $service)
                                <li><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
