@extends('layouts.app')

@section('content')
    <article class="section service-page">
        <div class="container">
            <div class="content-layout">
                <div class="content-main">
                    {!! $content !!}

                    {{-- Service FAQ Section --}}
                    <section class="service-faq-section">
                        <h2>أسئلة شائعة عن {{ $service['title_ar'] }}</h2>
                        @include('components.faq-accordion', ['faqs' => $faqs])
                    </section>
                </div>

                <aside class="content-sidebar">
                    {{-- Quick Contact --}}
                    <div class="sidebar-card sidebar-contact">
                        <h3>تواصل معنا الآن</h3>
                        <p>احصل على أفضل سعر لأثاثك المستعمل</p>
                        <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-block"
                            data-track="sidebar-call">📞 {{ config('business.phone') }}</a>
                        <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-block" target="_blank"
                            rel="noopener" data-track="sidebar-whatsapp">💬 واتساب</a>
                    </div>

                    {{-- Other Services --}}
                    <div class="sidebar-card">
                        <h3>خدمات أخرى</h3>
                        <ul class="sidebar-links">
                            @foreach ($otherServices as $s)
                                <li><a href="{{ url('/services/' . $s['slug']) }}">{{ $s['title_ar'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Districts Links --}}
                    <div class="sidebar-card">
                        <h3>أحياء جدة</h3>
                        <ul class="sidebar-links">
                            @foreach (config('jeddah_districts.clusters') as $cluster)
                                <li><a href="{{ url('/districts/' . $cluster['slug']) }}">{{ $cluster['name_ar'] }}</a></li>
                            @endforeach
                        </ul>
                        <a href="{{ url('/districts') }}" class="sidebar-more-link">جميع الأحياء ←</a>
                    </div>
                </aside>
            </div>
        </div>
    </article>

    @include('components.related-links')
@endsection
