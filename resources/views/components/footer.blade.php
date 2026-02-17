{{-- Footer --}}
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            {{-- About Column --}}
            <div class="footer-col">
                <h3 class="footer-title">{{ config('business.name_ar') }}</h3>
                <p class="footer-desc">
                    شركة متخصصة في شراء الأثاث المستعمل والعفش والمكيفات والمطابخ والسكراب في جدة. نقدم أعلى الأسعار مع
                    خدمة فك ونقل مجانية ودفع نقدي فوري.
                </p>
                <div class="footer-contact-info">
                    <p><strong>الهاتف:</strong> <a href="tel:{{ config('business.phone') }}"
                            data-track="footer-call">{{ config('business.phone') }}</a></p>
                    <p><strong>البريد:</strong> {{ config('business.email') }}</p>
                    <p><strong>العنوان:</strong> {{ config('business.address_ar') }}</p>
                </div>
            </div>

            {{-- Services Column --}}
            <div class="footer-col">
                <h3 class="footer-title">خدماتنا</h3>
                <ul class="footer-links">
                    @foreach (config('business.services') as $service)
                        <li><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Quick Links Column --}}
            <div class="footer-col">
                <h3 class="footer-title">روابط سريعة</h3>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}">الرئيسية</a></li>
                    <li><a href="{{ url('/services') }}">خدماتنا</a></li>
                    <li><a href="{{ url('/districts') }}">أحياء جدة</a></li>
                    <li><a href="{{ url('/faq') }}">الأسئلة الشائعة</a></li>
                    <li><a href="{{ url('/about') }}">من نحن</a></li>
                    <li><a href="{{ url('/contact') }}">اتصل بنا</a></li>
                    <li><a href="{{ url('/video') }}">فيديو</a></li>
                    <li><a href="{{ url('/sitemap') }}">خريطة الموقع</a></li>
                </ul>
            </div>

            {{-- Map Column --}}
            <div class="footer-col">
                <h3 class="footer-title">موقعنا</h3>
                <div class="footer-map">
                    <iframe src="{{ config('business.google_map_embed') }}" width="100%" height="200"
                        style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="موقع شركة شراء الأثاث المستعمل في جدة"></iframe>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ config('business.name_ar') }}. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>
