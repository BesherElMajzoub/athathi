{{-- Breadcrumbs Component --}}
@if (isset($breadcrumbs))
    <nav class="breadcrumbs-nav" aria-label="مسار التنقل">
        <div class="container">
            <ol class="breadcrumbs-list">
                @php
                    $items = $breadcrumbs['itemListElement'] ?? [];
                @endphp
                @foreach ($items as $i => $item)
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                        @if (!$loop->last && isset($item['item']))
                            <a href="{{ $item['item'] }}">{{ $item['name'] }}</a>
                        @else
                            <span>{{ $item['name'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </nav>
@endif
