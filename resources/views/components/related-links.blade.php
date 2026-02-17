{{-- Related Links Component --}}
{{-- Automated internal linking for services and districts --}}
@php
    $currentSlug = request()->route('slug') ?? '';
    $allServices = config('business.services');
    $clusters = config('jeddah_districts.clusters');
@endphp

<aside class="related-links-section">
    <div class="related-block">
        <h3>خدمات أخرى في جدة</h3>
        <ul class="related-list">
            @foreach ($allServices as $s)
                @if ($s['slug'] !== $currentSlug)
                    <li><a href="{{ url('/services/' . $s['slug']) }}">{{ $s['title_ar'] }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="related-block">
        <h3>أحياء جدة التي نخدمها</h3>
        <ul class="related-list related-districts">
            @foreach ($clusters as $cluster)
                <li><a href="{{ url('/districts/' . $cluster['slug']) }}"><strong>{{ $cluster['name_ar'] }}</strong></a>
                </li>
                @foreach (array_slice($cluster['neighborhoods'], 0, 3) as $n)
                    <li><a href="{{ url('/districts/' . $cluster['slug'] . '/' . $n['slug']) }}">{{ $n['name_ar'] }}</a>
                    </li>
                @endforeach
            @endforeach
        </ul>
    </div>
</aside>
