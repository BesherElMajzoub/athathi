@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section" id="hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">شراء اثاث مستعمل بجدة بأعلى الأسعار</h1>
                <p class="hero-subtitle">
                    نحن الشركة الرائدة في شراء اثاث مستعمل بجدة وشراء عفش مستعمل جدة بأعلى الأسعار في السوق.
                    نشتري مكيفات مستعملة وجميع أنواع الأثاث المنزلي والمكتبي.
                    متخصصون في شراء سكراب بجدة وشراء مطابخ مستعملة مع خدمة الفك والنقل المجاني والدفع النقدي الفوري.
                    فريقنا المحترف يصل إليك في أي حي من أحياء جدة خلال دقائق معدودة لتقديم أفضل عرض سعر.
                    سنوات من الخبرة والثقة جعلتنا الخيار الأول لآلاف العملاء في جميع مناطق جدة.
                </p>
                <div class="hero-cta">
                    <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-lg" data-track="hero-call">
                        📞 اتصل الآن: {{ config('business.phone') }}
                    </a>
                    <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-lg" target="_blank"
                        rel="noopener" data-track="hero-whatsapp">
                        💬 واتساب فوري
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Preview --}}
    <section class="section services-section" id="services-preview">
        <div class="container">
            <div class="section-header">
                <h2>خدماتنا في شراء الأثاث المستعمل بجدة</h2>
                <p>نقدم مجموعة شاملة من خدمات شراء الأثاث المستعمل في جميع أحياء جدة</p>
            </div>
            <div class="services-grid">
                @foreach ($services as $service)
                    <article class="service-card">
                        <div class="service-card-icon">
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
                        <h3 class="service-card-title">
                            <a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a>
                        </h3>
                        <p class="service-card-desc">{{ $service['short_desc'] }}</p>
                        <a href="{{ url('/services/' . $service['slug']) }}" class="service-card-link">
                            اعرف المزيد ←
                        </a>
                    </article>
                @endforeach
            </div>
            <div class="section-cta">
                <a href="{{ url('/services') }}" class="btn btn-outline">عرض جميع الخدمات</a>
            </div>
        </div>
    </section>

    {{-- Trust Section --}}
    <section class="section trust-section" id="trust">
        <div class="container">
            <div class="section-header">
                <h2>لماذا نحن الخيار الأفضل في جدة؟</h2>
                <p>سنوات من الخبرة والتميز في خدمة عملائنا في جميع أحياء جدة</p>
            </div>
            <div class="trust-grid">
                <div class="trust-item">
                    <div class="trust-icon">💰</div>
                    <h3>أعلى الأسعار</h3>
                    <p>نقدم أعلى أسعار شراء الأثاث المستعمل في جدة مقارنة بأي منافس آخر.</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">⚡</div>
                    <h3>سرعة الوصول</h3>
                    <p>نصل إليك خلال 30 دقيقة في أي حي من أحياء جدة.</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">🚚</div>
                    <h3>فك ونقل مجاني</h3>
                    <p>خدمة فك ونقل احترافية ومجانية بالكامل لجميع القطع المشتراة.</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">💵</div>
                    <h3>دفع نقدي فوري</h3>
                    <p>نقوم بالدفع نقدياً فور الاتفاق على السعر دون أي تأخير.</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">🕐</div>
                    <h3>خدمة 24/7</h3>
                    <p>متاحون على مدار الساعة طوال أيام الأسبوع بما في ذلك العطلات.</p>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">✅</div>
                    <h3>ثقة وأمان</h3>
                    <p>شركة موثوقة بسنوات من الخبرة وآلاف العملاء الراضين في جدة.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How We Work --}}
    <section class="section how-section" id="how-we-work">
        <div class="container">
            <div class="section-header">
                <h2>كيف نعمل - خطوات بسيطة وسريعة</h2>
                <p>عملية شراء الأثاث المستعمل لدينا سهلة وسريعة</p>
            </div>
            <div class="steps-grid">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <h3>اتصل بنا</h3>
                    <p>تواصل معنا عبر الهاتف أو الواتساب وأخبرنا بالقطع المراد بيعها.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <h3>نصل إليك</h3>
                    <p>فريقنا يصلك خلال دقائق لمعاينة الأثاث في موقعك.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <h3>تقييم وعرض سعر</h3>
                    <p>نقدم لك أفضل عرض سعر بناءً على تقييم احترافي.</p>
                </div>
                <div class="step-item">
                    <div class="step-number">4</div>
                    <h3>دفع وتسليم</h3>
                    <p>بعد الموافقة، ندفع فوراً ونتولى الفك والنقل بالكامل.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Districts Preview --}}
    <section class="section districts-preview" id="districts">
        <div class="container">
            <div class="section-header">
                <h2>أحياء جدة التي نخدمها</h2>
                <p>نغطي جميع أحياء ومناطق جدة بخدمة شراء الأثاث المستعمل</p>
            </div>
            <div class="districts-grid">
                @foreach (config('jeddah_districts.clusters') as $cluster)
                    <div class="district-card">
                        <h3><a href="{{ url('/districts/' . $cluster['slug']) }}">{{ $cluster['name_ar'] }}</a></h3>
                        <ul>
                            @foreach (array_slice($cluster['neighborhoods'], 0, 4) as $n)
                                <li><a
                                        href="{{ url('/districts/' . $cluster['slug'] . '/' . $n['slug']) }}">{{ $n['name_ar'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ url('/districts/' . $cluster['slug']) }}" class="district-card-more">عرض جميع الأحياء
                            ←</a>
                    </div>
                @endforeach
            </div>
            <div class="section-cta">
                <a href="{{ url('/districts') }}" class="btn btn-outline">جميع أحياء جدة</a>
            </div>
        </div>
    </section>

    {{-- Video Section --}}
    <section class="section video-section" id="video">
        <div class="container">
            <div class="section-header">
                <h2>شاهد كيف نعمل</h2>
                <p>فيديو توضيحي عن خدمة شراء الأثاث المستعمل في جدة</p>
            </div>
            <div class="video-wrapper">
                @include('components.lite-youtube')
            </div>
        </div>
    </section>

    {{-- FAQ Preview --}}
    <section class="section faq-section" id="faq-preview">
        <div class="container">
            <div class="section-header">
                <h2>الأسئلة الشائعة</h2>
                <p>إجابات على أكثر الأسئلة شيوعاً حول شراء الأثاث المستعمل في جدة</p>
            </div>
            @include('components.faq-accordion', ['faqs' => $faqs])
            <div class="section-cta">
                <a href="{{ url('/faq') }}" class="btn btn-outline">جميع الأسئلة الشائعة</a>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="section cta-final-section" id="cta-final">
        <div class="container">
            <div class="cta-final-content">
                <h2>جاهز لبيع أثاثك المستعمل؟</h2>
                <p>تواصل معنا الآن واحصل على أفضل سعر في جدة. نصل إليك فوراً!</p>
                <div class="cta-final-buttons">
                    <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-lg"
                        data-track="cta-final-call">
                        📞 اتصل الآن: {{ config('business.phone') }}
                    </a>
                    <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-lg" target="_blank"
                        rel="noopener" data-track="cta-final-whatsapp">
                        💬 راسلنا واتساب
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
