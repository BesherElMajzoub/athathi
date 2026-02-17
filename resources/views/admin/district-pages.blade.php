<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة صفحات الأحياء | {{ config('business.name_ar') }}</title>
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

        .filters {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filters a {
            color: #BBCB2E;
            text-decoration: none;
            padding: 6px 14px;
            border: 1px solid #2a2b36;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .filters a.active,
        .filters a:hover {
            background: #6B7445;
            color: #fff;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
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

        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .badge-published {
            background: #6CA65130;
            color: #6CA651;
        }

        .badge-draft {
            background: #ff990030;
            color: #ff9900;
        }

        .btn-sm {
            padding: 4px 12px;
            font-size: 0.85rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-toggle {
            background: #6B7445;
            color: #fff;
        }

        .btn-toggle:hover {
            background: #839705;
        }

        .pagination {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            justify-content: center;
        }

        .pagination a,
        .pagination span {
            padding: 6px 12px;
            border: 1px solid #2a2b36;
            border-radius: 6px;
            text-decoration: none;
            color: #BBCB2E;
        }

        .pagination span {
            background: #6B7445;
            color: #fff;
        }

        .success-msg {
            background: #6CA65120;
            border: 1px solid #6CA651;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #6CA651;
        }

        .overflow-x {
            overflow-x: auto;
        }

        .card {
            background: #1a1b26;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #2a2b36;
        }
    </style>
</head>

<body>
    <header class="admin-header">
        <h1>🏠 إدارة صفحات الأحياء</h1>
        <a href="{{ url('/') }}">العودة للموقع</a>
    </header>

    <div class="admin-container">
        <div class="nav-links">
            <a href="{{ route('admin.dashboard') }}">الإحصائيات</a>
            <a href="{{ route('admin.district-pages') }}" class="active">صفحات الأحياء</a>
        </div>

        @if (session('success'))
            <div class="success-msg">{{ session('success') }}</div>
        @endif

        <div class="filters">
            <a href="{{ route('admin.district-pages') }}" class="{{ !request('status') ? 'active' : '' }}">الكل</a>
            <a href="{{ route('admin.district-pages', ['status' => 'published']) }}"
                class="{{ request('status') === 'published' ? 'active' : '' }}">منشور</a>
            <a href="{{ route('admin.district-pages', ['status' => 'draft']) }}"
                class="{{ request('status') === 'draft' ? 'active' : '' }}">مسودة</a>
        </div>

        <div class="card">
            <div class="overflow-x">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الحي</th>
                            <th>المنطقة</th>
                            <th>الحالة</th>
                            <th>عدد الكلمات</th>
                            <th>تاريخ الإنشاء</th>
                            <th>إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->neighborhood_name_ar }}</td>
                                <td>{{ $page->cluster_name_ar }}</td>
                                <td>
                                    <span class="badge badge-{{ $page->status }}">
                                        {{ $page->status === 'published' ? 'منشور' : 'مسودة' }}
                                    </span>
                                </td>
                                <td>{{ number_format($page->word_count) }}</td>
                                <td>{{ $page->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <form action="{{ route('admin.district-pages.toggle', $page) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-toggle">
                                            {{ $page->status === 'published' ? 'إلغاء النشر' : 'نشر' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding: 40px;">
                                    لا توجد صفحات بعد. استخدم الأمر: <code>php artisan
                                        content:generate-district-pages</code>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $pages->links('pagination::simple-default') }}
            </div>
        </div>
    </div>
</body>

</html>
