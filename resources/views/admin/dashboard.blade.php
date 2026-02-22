<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | {{ config('business.name_ar') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: #0f1017;
            color: #e0e0e0;
            direction: rtl;
            line-height: 1.6;
        }

        .admin-header {
            background: linear-gradient(135deg, #6B7445, #839705);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            color: #fff;
            font-size: 1.4rem;
        }

        .admin-header a {
            color: #BBCB2E;
            text-decoration: none;
        }

        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #1a1b26;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #2a2b36;
        }

        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: #BBCB2E;
        }

        .stat-card .stat-label {
            font-size: 0.9rem;
            color: #888;
            margin-top: 4px;
        }

        .section-title {
            font-size: 1.3rem;
            margin-bottom: 16px;
            color: #BBCB2E;
            border-bottom: 2px solid #2a2b36;
            padding-bottom: 8px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .data-table th {
            background: #1a1b26;
            padding: 12px 16px;
            text-align: right;
            font-weight: 600;
            color: #BBCB2E;
            border-bottom: 2px solid #2a2b36;
        }

        .data-table td {
            padding: 10px 16px;
            border-bottom: 1px solid #1a1b26;
        }

        .data-table tr:hover {
            background: #1a1b2680;
        }

        .data-table .count {
            color: #BBCB2E;
            font-weight: 700;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .badge-mobile {
            background: #6B744520;
            color: #BBCB2E;
        }

        .badge-desktop {
            background: #6CA65120;
            color: #6CA651;
        }

        .badge-tablet {
            background: #83970520;
            color: #839705;
        }

        .card {
            background: #1a1b26;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #2a2b36;
            margin-bottom: 20px;
        }

        .nav-links {
            display: flex;
            gap: 16px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #BBCB2E;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid #2a2b36;
            border-radius: 8px;
            transition: 0.2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: #6B7445;
            color: #fff;
        }

        .filter-links {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
            color: #888;
            font-size: 0.9rem;
        }

        .filter-links a {
            color: #BBCB2E;
            text-decoration: none;
            padding: 6px 12px;
            border: 1px solid #2a2b36;
            border-radius: 999px;
            transition: 0.2s;
        }

        .filter-links a:hover,
        .filter-links a.active {
            background: #6B7445;
            color: #fff;
        }

        .overflow-x {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <header class="admin-header">
        <h1>🏠 لوحة التحكم - {{ config('business.name_ar') }}</h1>
        <div>
            <a href="{{ url('/') }}">العودة للموقع</a>
        </div>
    </header>

    <div class="admin-container">
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="active">الإحصائيات</a>
            <a href="{{ route('admin.district-pages') }}">صفحات الأحياء</a>
        </div>

        {{-- Stats Cards --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value">{{ number_format($totalVisits) }}</div>
                <div class="stat-label">إجمالي الزيارات</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($todayVisits) }}</div>
                <div class="stat-label">زيارات اليوم</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($weekVisits) }}</div>
                <div class="stat-label">آخر 7 أيام</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($monthVisits) }}</div>
                <div class="stat-label">آخر 30 يوم</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ number_format($totalClicks) }}</div>
                <div class="stat-label">إجمالي النقرات</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $districtPagesPublished }}/{{ $districtPagesTotal }}</div>
                <div class="stat-label">صفحات أحياء منشورة</div>
            </div>
        </div>

        <div class="grid-2">
            {{-- Top Pages --}}
            <div class="card">
                <h2 class="section-title">أكثر الصفحات زيارة</h2>
                <div class="overflow-x">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>الصفحة</th>
                                <th>الزيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topPages as $page)
                                <tr>
                                    <td>/{{ $page->page }}</td>
                                    <td class="count">{{ number_format($page->visits) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Top Buttons --}}
            <div class="card">
                <h2 class="section-title">أكثر الأزرار نقراً</h2>
                <div class="filter-links">
                    <span>المدة:</span>
                    <a href="{{ request()->fullUrlWithQuery(['range' => 1]) }}"
                        class="{{ $clickRange === 1 ? 'active' : '' }}">اليوم</a>
                    <a href="{{ request()->fullUrlWithQuery(['range' => 7]) }}"
                        class="{{ $clickRange === 7 ? 'active' : '' }}">7 أيام</a>
                    <a href="{{ request()->fullUrlWithQuery(['range' => 30]) }}"
                        class="{{ $clickRange === 30 ? 'active' : '' }}">30 يوم</a>
                    <a href="{{ request()->fullUrlWithQuery(['range' => 0]) }}"
                        class="{{ $clickRange === 0 ? 'active' : '' }}">الكل</a>
                </div>
                <div class="overflow-x">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>الزر</th>
                                <th>التسمية</th>
                                <th>النقرات</th>
                                <th>آخر نقرة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topButtons as $btn)
                                <tr>
                                    <td>{{ $btn->button_id }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($btn->button_label, 30) }}</td>
                                    <td class="count">{{ number_format($btn->clicks) }}</td>
                                    <td title="{{ $btn->last_click_at ? \Illuminate\Support\Carbon::parse($btn->last_click_at)->format('Y-m-d H:i') : '' }}">{{ $btn->last_click_at ? \Illuminate\Support\Carbon::parse($btn->last_click_at)->diffForHumans() : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="grid-2">
            {{-- Referrer Sources --}}
            <div class="card">
                <h2 class="section-title">مصادر الزيارات</h2>
                <div class="overflow-x">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>المصدر</th>
                                <th>العدد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($referrerSources as $ref)
                                <tr>
                                    <td>{{ \Illuminate\Support\Str::limit($ref->referrer, 50) }}</td>
                                    <td class="count">{{ number_format($ref->count) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Device Stats --}}
            <div class="card">
                <h2 class="section-title">الأجهزة</h2>
                <div class="overflow-x">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>النوع</th>
                                <th>العدد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deviceStats as $device)
                                <tr>
                                    <td>
                                        <span class="badge badge-{{ $device->device_type }}">
                                            {{ $device->device_type === 'mobile' ? 'جوال' : ($device->device_type === 'desktop' ? 'كمبيوتر' : 'تابلت') }}
                                        </span>
                                    </td>
                                    <td class="count">{{ number_format($device->count) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Recent Visits --}}
        <div class="card">
            <h2 class="section-title">آخر 50 زيارة</h2>
            <div class="overflow-x">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>الصفحة</th>
                            <th>الجهاز</th>
                            <th>المصدر</th>
                            <th>الوقت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentVisits as $visit)
                            <tr>
                                <td>/{{ $visit->page }}</td>
                                <td>
                                    <span class="badge badge-{{ $visit->device_type }}">
                                        {{ $visit->device_type === 'mobile' ? 'جوال' : ($visit->device_type === 'desktop' ? 'كمبيوتر' : 'تابلت') }}
                                    </span>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($visit->referrer, 30) ?: '-' }}</td>
                                <td>{{ $visit->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
