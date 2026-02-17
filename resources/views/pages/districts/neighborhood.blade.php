@extends('layouts.app')

@section('content')
    <article class="section neighborhood-page">
        <div class="container">
            <div class="content-layout">
                <div class="content-main">
                    {!! $content !!}

                    {{-- Neighborhood FAQ --}}
                    @if (!empty($faqs))
                        <section class="neighborhood-faq">
                            <h2>أسئلة شائعة عن شراء الأثاث المستعمل في {{ $neighborhoodData['name_ar'] }}</h2>
                            @include('components.faq-accordion', ['faqs' => $faqs])
                        </section>
                    @endif

                    {{-- Nearby Neighborhoods --}}
                    @if (!empty($nearby))
                        <section class="nearby-neighborhoods">
                            <h2>أحياء قريبة من {{ $neighborhoodData['name_ar'] }}</h2>
                            <div class="nearby-grid">
                                @foreach ($nearby as $n)
                                    <a href="{{ url('/districts/' . $cluster . '/' . $n['slug']) }}" class="nearby-card">
                                        <span class="nearby-name">{{ $n['name_ar'] }}</span>
                                        <span class="nearby-desc">شراء اثاث مستعمل في {{ $n['name_ar'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <aside class="content-sidebar">
                    <div class="sidebar-card sidebar-contact">
                        <h3>تواصل معنا في {{ $neighborhoodData['name_ar'] }}</h3>
                        <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-block"
                            data-track="neighborhood-sidebar-call">📞 {{ config('business.phone') }}</a>
                        <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-block" target="_blank"
                            rel="noopener" data-track="neighborhood-sidebar-whatsapp">💬 واتساب</a>
                    </div>

                    <div class="sidebar-card">
                        <h3>خدماتنا في {{ $neighborhoodData['name_ar'] }}</h3>
                        <ul class="sidebar-links">
                            @foreach (config('business.services') as $service)
                                <li><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-card">
                        <h3>{{ $clusterData['name_ar'] }}</h3>
                        <ul class="sidebar-links">
                            @foreach (array_slice($clusterData['neighborhoods'], 0, 8) as $n)
                                <li>
                                    <a href="{{ url('/districts/' . $cluster . '/' . $n['slug']) }}"
                                        class="{{ $n['slug'] === $neighborhoodData['slug'] ? 'active' : '' }}">
                                        {{ $n['name_ar'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ url('/districts/' . $cluster) }}" class="sidebar-more-link">عرض الكل ←</a>
                    </div>
                </aside>
            </div>
        </div>
    </article>
@endsection
