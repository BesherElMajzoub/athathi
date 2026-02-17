<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة غير موجودة | شراء اثاث مستعمل بجدة</title>
    <meta name="robots" content="noindex, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="rtl-body">
    <div class="error-page">
        <div class="error-content">
            <div class="error-code">404</div>
            <h1>عذراً - الصفحة غير موجودة</h1>
            <p>الصفحة التي تبحث عنها قد تم نقلها أو حذفها أو أن الرابط غير صحيح.</p>
            <p>يمكنك الانتقال إلى إحدى الصفحات التالية:</p>

            <div class="error-links">
                <a href="{{ url('/') }}" class="btn btn-primary">الصفحة الرئيسية</a>
                <a href="{{ url('/services') }}" class="btn btn-outline">خدماتنا</a>
                <a href="{{ url('/contact') }}" class="btn btn-outline">اتصل بنا</a>
                <a href="{{ url('/faq') }}" class="btn btn-outline">الأسئلة الشائعة</a>
            </div>

            <div class="error-services">
                <h2>خدماتنا الرئيسية</h2>
                <ul>
                    @foreach (config('business.services') as $service)
                        <li><a href="{{ url('/services/' . $service['slug']) }}">{{ $service['title_ar'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="error-contact">
                <p>أو تواصل معنا مباشرة:</p>
                <a href="tel:{{ config('business.phone') }}" class="btn btn-primary">📞
                    {{ config('business.phone') }}</a>
            </div>
        </div>
    </div>
</body>

</html>
