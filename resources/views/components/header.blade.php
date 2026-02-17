{{-- Sticky Header --}}
<header class="site-header" id="site-header">
    <div class="header-top-bar">
        <div class="container">
            <div class="top-bar-content">
                <span class="top-bar-text">
                    <span class="top-bar-icon">🕐</span>
                    {{ config('business.working_hours_ar') }}
                </span>
                <a href="tel:{{ config('business.phone') }}" class="top-bar-phone" data-track="header-call">
                    <span class="top-bar-icon">📞</span>
                    {{ config('business.phone') }}
                </a>
            </div>
        </div>
    </div>

    <nav class="main-nav" id="main-nav">
        <div class="container">
            <div class="nav-content">
                <a href="{{ url('/') }}" class="nav-logo" aria-label="الصفحة الرئيسية">
                    <span class="logo-icon">🏠</span>
                    <span class="logo-text">{{ config('business.name_ar') }}</span>
                </a>

                <button class="nav-toggle" id="nav-toggle" aria-label="فتح القائمة" aria-expanded="false">
                    <span class="hamburger"></span>
                </button>

                <ul class="nav-menu" id="nav-menu">
                    <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">الرئيسية</a></li>
                    <li class="has-dropdown">
                        <a href="{{ url('/services') }}"
                            class="{{ request()->is('services*') ? 'active' : '' }}">خدماتنا</a>
                        <ul class="dropdown-menu">
                            @foreach (config('business.services') as $service)
                                <li><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ url('/districts') }}"
                            class="{{ request()->is('districts*') ? 'active' : '' }}">أحياء جدة</a></li>
                    <li><a href="{{ url('/faq') }}" class="{{ request()->is('faq') ? 'active' : '' }}">الأسئلة
                            الشائعة</a></li>
                    <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">من نحن</a>
                    </li>
                    <li><a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">اتصل
                            بنا</a></li>
                    <li class="nav-cta">
                        <a href="tel:{{ config('business.phone') }}" class="btn btn-cta-nav" data-track="nav-call">
                            📞 اتصل الآن
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.getElementById('nav-toggle').addEventListener('click', function() {
        var menu = document.getElementById('nav-menu');
        var isOpen = menu.classList.toggle('open');
        this.classList.toggle('active');
        this.setAttribute('aria-expanded', isOpen);
    });

    // Sticky header
    var header = document.getElementById('site-header');
    var lastScrollY = 0;
    window.addEventListener('scroll', function() {
        var scrollY = window.scrollY;
        if (scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        lastScrollY = scrollY;
    }, {
        passive: true
    });
</script>
