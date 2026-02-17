@extends('layouts.app')

@section('content')
    <section class="section page-header-section">
        <div class="container">
            <h1>خريطة الموقع</h1>
            <p class="page-intro">تصفح جميع صفحات موقعنا للوصول السريع إلى المعلومات التي تبحث عنها.</p>
        </div>
    </section>

    <section class="section sitemap-section">
        <div class="container">
            <div class="sitemap-grid">
                {{-- Main Pages --}}
                <div class="sitemap-block">
                    <h2>الصفحات الرئيسية</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">الرئيسية</a></li>
                        <li><a href="{{ url('/services') }}">خدماتنا</a></li>
                        <li><a href="{{ url('/districts') }}">أحياء جدة</a></li>
                        <li><a href="{{ url('/faq') }}">الأسئلة الشائعة</a></li>
                        <li><a href="{{ url('/about') }}">من نحن</a></li>
                        <li><a href="{{ url('/contact') }}">اتصل بنا</a></li>
                        <li><a href="{{ url('/video') }}">فيديو</a></li>
                    </ul>
                </div>

                {{-- Services --}}
                <div class="sitemap-block">
                    <h2>خدماتنا</h2>
                    <ul>
                        @foreach ($services as $service)
                            <li><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Districts --}}
                @foreach ($clusters as $clusterKey => $cluster)
                    <div class="sitemap-block">
                        <h2><a href="{{ url('/districts/' . $cluster['slug']) }}">{{ $cluster['name_ar'] }}</a></h2>
                        <ul>
                            @foreach ($cluster['neighborhoods'] as $neighborhood)
                                <li><a
                                        href="{{ url('/districts/' . $cluster['slug'] . '/' . $neighborhood['slug']) }}">{{ $neighborhood['name_ar'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
