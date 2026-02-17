@extends('layouts.app')

@section('content')
    <article class="section cluster-page">
        <div class="container">
            <div class="content-layout">
                <div class="content-main">
                    {!! $content !!}
                </div>

                <aside class="content-sidebar">
                    <div class="sidebar-card sidebar-contact">
                        <h3>تواصل معنا</h3>
                        <p>خدمة سريعة في {{ $clusterData['name_ar'] }}</p>
                        <a href="tel:{{ config('business.phone') }}" class="btn btn-primary btn-block"
                            data-track="cluster-sidebar-call">📞 {{ config('business.phone') }}</a>
                        <a href="{{ config('business.whatsapp_url') }}" class="btn btn-whatsapp btn-block" target="_blank"
                            rel="noopener" data-track="cluster-sidebar-whatsapp">💬 واتساب</a>
                    </div>

                    <div class="sidebar-card">
                        <h3>خدماتنا</h3>
                        <ul class="sidebar-links">
                            @foreach (config('business.services') as $service)
                                <li><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-card">
                        <h3>مناطق أخرى</h3>
                        <ul class="sidebar-links">
                            @foreach (config('jeddah_districts.clusters') as $key => $c)
                                @if ($key !== $cluster)
                                    <li><a href="{{ url('/districts/' . $c['slug']) }}">{{ $c['name_ar'] }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </article>
@endsection
