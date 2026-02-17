@extends('layouts.app')

@section('content')
    <section class="section page-header-section">
        <div class="container">
            <h1>{{ config('jeddah_districts.hub_title_ar') }}</h1>
            <p class="page-intro">
                نقدم خدمة شراء الأثاث المستعمل والعفش والمكيفات والسكراب في جميع أحياء جدة.
                نغطي شمال وجنوب وشرق ووسط وغرب جدة بخدمة سريعة واحترافية.
                اختر منطقتك أدناه وتواصل معنا للحصول على أفضل عرض سعر في حيك.
                فريقنا المتخصص يصل لأي موقع في جدة خلال دقائق معدودة مع خدمة الفك والنقل المجاني والدفع النقدي الفوري.
                سنوات من الخبرة في خدمة سكان جدة بجميع مناطقها جعلتنا الشركة الأولى في مجال شراء الأثاث المستعمل.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="clusters-grid">
                @foreach ($clusters as $clusterKey => $cluster)
                    <div class="cluster-card" id="{{ $cluster['slug'] }}">
                        <h2 class="cluster-title">
                            <a href="{{ url('/districts/' . $cluster['slug']) }}">شراء اثاث مستعمل في
                                {{ $cluster['name_ar'] }}</a>
                        </h2>
                        <p class="cluster-desc">
                            نقدم خدمة شراء الأثاث المستعمل في جميع أحياء {{ $cluster['name_ar'] }} بأعلى الأسعار. تغطية
                            شاملة وخدمة سريعة.
                        </p>
                        <div class="neighborhoods-grid">
                            @foreach ($cluster['neighborhoods'] as $neighborhood)
                                <a href="{{ url('/districts/' . $cluster['slug'] . '/' . $neighborhood['slug']) }}"
                                    class="neighborhood-link">
                                    <span class="neighborhood-name">{{ $neighborhood['name_ar'] }}</span>
                                    <span class="neighborhood-arrow">←</span>
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ url('/districts/' . $cluster['slug']) }}" class="btn btn-outline btn-sm cluster-btn">
                            عرض تفاصيل {{ $cluster['name_ar'] }} ←
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="section services-section">
        <div class="container">
            <h2 class="section-title-center">خدماتنا في جميع أحياء جدة</h2>
            <div class="services-grid">
                @foreach (config('business.services') as $service)
                    <div class="service-card-mini">
                        <h3><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a></h3>
                        <p>{{ $service['short_desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="section cta-final-section">
        <div class="container">
            <div class="cta-final-content">
                <h2>نغطي جميع أحياء جدة - تواصل معنا الآن</h2>
                <p>اتصل بنا أو أرسل واتساب وسنصل لك فوراً في أي حي!</p>
                <div class="cta-final-buttons">
                    <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-lg"
                        data-track="districts-hub-call">📞 {{ config('business.phone') }}</a>
                    <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-lg" target="_blank"
                        rel="noopener" data-track="districts-hub-whatsapp">💬 واتساب</a>
                </div>
            </div>
        </div>
    </section>
@endsection
