<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TrackingController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\TrackVisit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Apply visit tracking to all public routes
Route::middleware([TrackVisit::class])->group(function () {

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])
        ->where('slug', '[^/]+')
        ->name('services.show');

    // Districts (Local SEO)
    Route::get('/districts', [DistrictController::class, 'hub'])->name('districts.hub');
    Route::get('/districts/{cluster}', [DistrictController::class, 'cluster'])
        ->where('cluster', '[a-z\-]+')
        ->name('districts.cluster');
    Route::get('/districts/{cluster}/{neighborhood}', [DistrictController::class, 'neighborhood'])
        ->where(['cluster' => '[a-z\-]+', 'neighborhood' => '[a-z\-]+'])
        ->name('districts.neighborhood');

    // Static Pages
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/video', [PageController::class, 'video'])->name('video');
    Route::get('/sitemap', [PageController::class, 'sitemapHtml'])->name('sitemap.html');
});

// XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'xml'])->name('sitemap.xml');

// Tracking API
Route::post('/api/track-click', [TrackingController::class, 'trackClick'])
    ->name('track.click');

// Admin Routes
Route::prefix('admin')->middleware([AdminAuth::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/district-pages', [AdminController::class, 'districtPages'])->name('admin.district-pages');
    Route::post('/district-pages/{page}/toggle', [AdminController::class, 'toggleDistrictPage'])->name('admin.district-pages.toggle');
});
