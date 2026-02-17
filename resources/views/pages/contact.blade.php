@extends('layouts.app')

@section('content')
    <section class="section page-header-section">
        <div class="container">
            <h1>اتصل بنا - شراء اثاث مستعمل بجدة</h1>
            <p class="page-intro">
                تواصل معنا الآن للحصول على أفضل سعر لأثاثك المستعمل في جدة. نحن متاحون على مدار الساعة.
            </p>
        </div>
    </section>

    <section class="section contact-section">
        <div class="container">
            <div class="contact-grid">
                {{-- Contact Info --}}
                <div class="contact-info">
                    <div class="contact-card">
                        <div class="contact-card-icon">📞</div>
                        <h2>اتصل بنا</h2>
                        <p>يمكنك الاتصال بنا مباشرة على مدار الساعة</p>
                        <a href="tel:{{ config('business.phone') }}" class="contact-link"
                            data-track="contact-call">{{ config('business.phone') }}</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon">💬</div>
                        <h2>واتساب</h2>
                        <p>أرسل لنا رسالة واتساب وسنرد عليك فوراً</p>
                        <a href="{{ config('business.whatsapp_url') }}" class="contact-link" target="_blank" rel="noopener"
                            data-track="contact-whatsapp">تواصل عبر الواتساب</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon">📧</div>
                        <h2>البريد الإلكتروني</h2>
                        <p>أرسل لنا بريداً إلكترونياً وسنرد عليك في أقرب وقت</p>
                        <a href="mailto:{{ config('business.email') }}" class="contact-link"
                            data-track="contact-email">{{ config('business.email') }}</a>
                    </div>

                    <div class="contact-card">
                        <div class="contact-card-icon">📍</div>
                        <h2>العنوان</h2>
                        <p>{{ config('business.address_ar') }}</p>
                        <p><strong>ساعات العمل:</strong> {{ config('business.working_hours_ar') }}</p>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="contact-form-wrapper">
                    <h2>أرسل لنا رسالة</h2>
                    <form class="contact-form" id="contact-form" action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text" id="name" name="name" required placeholder="اسمك الكريم"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">رقم الجوال</label>
                            <input type="tel" id="phone" name="phone" required placeholder="05xxxxxxxx"
                                class="form-control" dir="ltr">
                        </div>
                        <div class="form-group">
                            <label for="service">الخدمة المطلوبة</label>
                            <select id="service" name="service" class="form-control">
                                <option value="">اختر الخدمة</option>
                                @foreach (config('business.services') as $service)
                                    <option value="{{ $service['title_ar'] }}">{{ $service['title_ar'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">تفاصيل الطلب</label>
                            <textarea id="message" name="message" rows="5" class="form-control"
                                placeholder="اكتب تفاصيل القطع المراد بيعها..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                            data-track="contact-form-submit">إرسال الطلب</button>
                    </form>
                </div>
            </div>

            {{-- Map --}}
            <div class="contact-map">
                <h2>موقعنا على الخريطة</h2>
                <iframe src="{{ config('business.google_map_embed') }}" width="100%" height="400"
                    style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="موقع شركة شراء الأثاث المستعمل في جدة على خرائط جوجل"></iframe>
            </div>
        </div>
    </section>
@endsection
