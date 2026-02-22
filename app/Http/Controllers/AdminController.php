<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\DistrictPage;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Admin dashboard.
     */
    public function dashboard()
    {
        $clickRange = (int) request()->query('range', 0);
        $allowedRanges = [0, 1, 7, 30];
        if (! in_array($clickRange, $allowedRanges, true)) {
            $clickRange = 0;
        }

        // Visit stats
        $totalVisits = Visit::count();
        $todayVisits = Visit::whereDate('created_at', today())->count();
        $weekVisits = Visit::where('created_at', '>=', now()->subDays(7))->count();
        $monthVisits = Visit::where('created_at', '>=', now()->subDays(30))->count();

        // Most visited pages
        $topPages = Visit::select('page', DB::raw('COUNT(*) as visits'))
            ->groupBy('page')
            ->orderByDesc('visits')
            ->limit(20)
            ->get();

        // Referrer sources
        $referrerSources = Visit::select('referrer', DB::raw('COUNT(*) as count'))
            ->whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->groupBy('referrer')
            ->orderByDesc('count')
            ->limit(15)
            ->get();

        // Device breakdown
        $deviceStats = Visit::select('device_type', DB::raw('COUNT(*) as count'))
            ->groupBy('device_type')
            ->orderByDesc('count')
            ->get();

        // Click stats
        $totalClicks = Click::count();
        $topButtonsQuery = Click::query();
        if ($clickRange > 0) {
            $topButtonsQuery->where('created_at', '>=', now()->subDays($clickRange));
        }

        $topButtons = $topButtonsQuery
            ->select(
                'button_id',
                'button_label',
                DB::raw('COUNT(*) as clicks'),
                DB::raw('MAX(created_at) as last_click_at'),
                DB::raw('MIN(created_at) as first_click_at')
            )
            ->groupBy('button_id', 'button_label')
            ->orderByDesc('clicks')
            ->limit(20)
            ->get();

        // Recent visits
        $recentVisits = Visit::latest()->limit(50)->get();

        // District pages stats
        $districtPagesTotal = DistrictPage::count();
        $districtPagesPublished = DistrictPage::published()->count();
        $districtPagesDraft = DistrictPage::where('status', 'draft')->count();

        // Daily visits chart (last 30 days)
        $dailyVisits = Visit::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalVisits', 'todayVisits', 'weekVisits', 'monthVisits',
            'topPages', 'referrerSources', 'deviceStats',
            'totalClicks', 'topButtons', 'clickRange',
            'recentVisits',
            'districtPagesTotal', 'districtPagesPublished', 'districtPagesDraft',
            'dailyVisits'
        ));
    }

    /**
     * District pages management.
     */
    public function districtPages(Request $request)
    {
        $query = DistrictPage::query();

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($cluster = $request->get('cluster')) {
            $query->where('cluster_key', $cluster);
        }

        $pages = $query->orderBy('cluster_key')->orderBy('neighborhood_name_ar')->paginate(25);

        return view('admin.district-pages', compact('pages'));
    }

    /**
     * Toggle district page status.
     */
    public function toggleDistrictPage(DistrictPage $page)
    {
        $page->status = $page->status === 'published' ? 'draft' : 'published';
        $page->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الصفحة بنجاح.');
    }
}
