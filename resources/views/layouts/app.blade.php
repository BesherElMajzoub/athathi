<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! $seo->render() !!}

    @hasSection('schemas')
        @yield('schemas')
    @endif

    @if (isset($schemas))
        @foreach ($schemas as $s)
            {!! $schema->render($s) !!}
        @endforeach
    @endif

    @if (isset($breadcrumbs))
        {!! $schema->render($breadcrumbs) !!}
    @endif

    {{-- Preload critical CSS --}}
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Preconnect for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- Tajawal Arabic Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.ico') }}">
    <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}">
    @stack('head')
</head>

<body class="rtl-body">
    {{-- Skip to main content (Accessibility) --}}
    <a href="#main-content" class="skip-link">تخطي إلى المحتوى الرئيسي</a>

    {{-- Header --}}
    @include('components.header')

    {{-- Breadcrumbs --}}
    @if (isset($breadcrumbs) && !request()->is('/'))
        @include('components.breadcrumbs')
    @endif

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Floating Buttons --}}
    @include('components.floating-buttons')

    {{-- Tracking Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track all CTA button clicks
            document.querySelectorAll('[data-track]').forEach(function(el) {
                el.addEventListener('click', function() {
                    var data = {
                        button_id: this.getAttribute('data-track'),
                        button_label: this.textContent.trim().substring(0, 200),
                        page: window.location.pathname
                    };

                    fetch('/api/track-click', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(data)
                    }).catch(function() {});
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
