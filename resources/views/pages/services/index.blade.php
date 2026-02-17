@extends('layouts.app')

@section('content')
    <section class="section page-header-section">
        <div class="container">
            <h1>خدماتنا في شراء الأثاث المستعمل بجدة</h1>
            <p class="page-intro">
                نقدم في جدة مجموعة متكاملة من خدمات شراء الأثاث المستعمل والعفش والمكيفات والمطابخ والسكراب بأعلى الأسعار.
                جميع خدماتنا تشمل المعاينة المجانية والفك والنقل الاحترافي والدفع النقدي الفوري.
                اختر الخدمة المناسبة وتواصل معنا للحصول على أفضل عرض سعر.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="services-grid services-grid-large">
                @foreach ($services as $service)
                    <article class="service-card service-card-lg">
                        <div class="service-card-icon service-card-icon-lg">
                            @switch($service['icon'])
                                @case('sofa')
                                    🛋️
                                @break

                                @case('bed')
                                    🛏️
                                @break

                                @case('snowflake')
                                    ❄️
                                @break

                                @case('crown')
                                    👑
                                @break

                                @case('recycle')
                                    ♻️
                                @break

                                @case('utensils')
                                    🍽️
                                @break

                                @default
                                    📦
                            @endswitch
                        </div>
                        <div class="service-card-body">
                            <h2 class="service-card-title">
                                <a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a>
                            </h2>
                            <p class="service-card-desc">{{ $service['short_desc'] }}</p>
                            <div class="service-card-actions">
                                <a href="{{ url('/services/' . $service['slug']) }}" class="btn btn-primary btn-sm">المزيد
                                    عن الخدمة</a>
                                <a href="tel:{{ config('business.phone') }}" class="btn btn-outline btn-sm"
                                    data-track="services-call-{{ $service['slug'] }}">📞 اتصل الآن</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="section cta-final-section">
        <div class="container">
            <div class="cta-final-content">
                <h2>لا تتردد - تواصل معنا الآن</h2>
                <p>احصل على أفضل سعر لأثاثك المستعمل في جدة. نصل إليك فوراً في أي حي!</p>
                <div class="cta-final-buttons">
                    <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-lg"
                        data-track="services-cta-call">📞 {{ config('business.phone') }}</a>
                    <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-lg" target="_blank"
                        rel="noopener" data-track="services-cta-whatsapp">💬 واتساب</a>
                </div>
            </div>
        </div>
    </section>
@endsection
