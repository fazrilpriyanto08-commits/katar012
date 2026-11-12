<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\UploadedMedia;
use Illuminate\Support\Facades\Route;

// Permanently serve uploaded images stored in PostgreSQL/SQLite
Route::get('/media/{uuid}', function (string $uuid) {
    $media = UploadedMedia::where('uuid', $uuid)->first();
    if (!$media) {
        return response('Not Found', 404);
    }
    $binary = base64_decode($media->data);

    return response($binary, 200, [
        'Content-Type' => $media->mime_type,
        'Content-Length' => strlen($binary),
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->name('media.show');

/*
|--------------------------------------------------------------------------
| Public Routes (Halaman Publik Warga)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'about'])->name('about');
Route::get('/agenda', [HomeController::class, 'events'])->name('events.index');
Route::get('/agenda/{slug}', [HomeController::class, 'eventDetail'])->name('events.show');
Route::get('/berita', [HomeController::class, 'articles'])->name('articles.index');
Route::get('/berita/{slug}', [HomeController::class, 'articleDetail'])->name('articles.show');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/hall-of-fame', [HomeController::class, 'hallOfFame'])->name('hall-of-fame');

// Kas & Inventaris hanya dapat diakses melalui Dashboard Pengurus
Route::get('/keuangan-17an', fn() => redirect()->route('admin.finances.index'))->name('finances');
Route::get('/inventaris', fn() => redirect()->route('admin.inventory.index'))->name('inventory');

// Aspirasi Warga
Route::get('/aspirasi-warga', [HomeController::class, 'aspiration'])->name('aspiration');
Route::post('/aspirasi-warga', [HomeController::class, 'storeAspiration'])->name('aspiration.store');

// Sensus / Pendataan Pemuda
Route::get('/images/{filename}', function ($filename) {
    $path = public_path('images/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $mimes = [
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'webp' => 'image/webp',
        'svg' => 'image/svg+xml',
    ];
    $contentType = $mimes[$ext] ?? 'image/jpeg';
    return response()->file($path, [
        'Content-Type' => $contentType,
        'Content-Disposition' => 'inline',
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->where('filename', '.*');

Route::get('/gabung-pemuda', [HomeController::class, 'youthRegistration'])->name('youth.register');
Route::post('/gabung-pemuda', [HomeController::class, 'storeYouthRegistration'])->name('youth.store');

// Pasar / Lapak UMKM Warga RT 12
Route::get('/lapak-warga', [HomeController::class, 'umkm'])->name('umkm.index');
Route::post('/lapak-warga', [HomeController::class, 'storeUmkm'])->name('umkm.store');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Pengurus Dashboard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Berita & Pengumuman
    Route::get('/articles', [AdminController::class, 'articles'])->name('articles.index');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminController::class, 'editArticle'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminController::class, 'updateArticle'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminController::class, 'deleteArticle'])->name('articles.delete');

    // Agenda Kegiatan
    Route::get('/events', [AdminController::class, 'events'])->name('events.index');
    Route::get('/events/create', [AdminController::class, 'createEvent'])->name('events.create');
    Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
    Route::put('/events/{event}', [AdminController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{event}', [AdminController::class, 'deleteEvent'])->name('events.delete');

    // Galeri
    Route::get('/galleries', [AdminController::class, 'galleries'])->name('galleries.index');
    Route::post('/galleries', [AdminController::class, 'storeGallery'])->name('galleries.store');
    Route::delete('/galleries/{gallery}', [AdminController::class, 'deleteGallery'])->name('galleries.delete');

    // Aspirasi Warga
    Route::get('/aspirations', [AdminController::class, 'aspirations'])->name('aspirations.index');
    Route::put('/aspirations/{aspiration}', [AdminController::class, 'updateAspirationStatus'])->name('aspirations.update');
    Route::delete('/aspirations/{aspiration}', [AdminController::class, 'deleteAspiration'])->name('aspirations.delete');

    // Database Pemuda
    Route::get('/youth', [AdminController::class, 'youthMembers'])->name('youth.index');
    Route::delete('/youth/{member}', [AdminController::class, 'deleteYouthMember'])->name('youth.delete');

    // Struktur Pengurus
    Route::get('/structures', [AdminController::class, 'structures'])->name('structures.index');
    Route::post('/structures', [AdminController::class, 'storeStructure'])->name('structures.store');
    Route::delete('/structures/{structure}', [AdminController::class, 'deleteStructure'])->name('structures.delete');

    // Kas & Anggaran 17-an
    Route::get('/finances', [AdminController::class, 'finances'])->name('finances.index');
    Route::post('/finances', [AdminController::class, 'storeFinance'])->name('finances.store');
    Route::delete('/finances/{finance}', [AdminController::class, 'deleteFinance'])->name('finances.delete');

    // Inventaris Barang / Perlengkapan
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory.index');
    Route::post('/inventory', [AdminController::class, 'storeInventory'])->name('inventory.store');
    Route::put('/inventory/{item}', [AdminController::class, 'updateInventory'])->name('inventory.update');
    Route::delete('/inventory/{item}', [AdminController::class, 'deleteInventory'])->name('inventory.delete');

    // Hall of Fame / Prestasi
    Route::get('/hall-of-fame', [AdminController::class, 'hallOfFame'])->name('hall-of-fame.index');
    Route::post('/hall-of-fame', [AdminController::class, 'storeHallOfFame'])->name('hall-of-fame.store');
    Route::put('/hall-of-fame/{item}', [AdminController::class, 'updateHallOfFame'])->name('hall-of-fame.update');
    Route::delete('/hall-of-fame/{item}', [AdminController::class, 'deleteHallOfFame'])->name('hall-of-fame.delete');

    // Akun Pengurus per Divisi (Registrasi & Kelola Akun)
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Log Aktivitas Pengurus (Audit Trail Khusus Admin)
    Route::get('/activity-logs', [AdminController::class, 'activityLogs'])->name('activity-logs.index');
    Route::delete('/activity-logs/clear', [AdminController::class, 'clearActivityLogs'])->name('activity-logs.clear');

    // Lapak UMKM Warga
    Route::get('/umkm', [AdminController::class, 'businesses'])->name('umkm.index');
    Route::post('/umkm', [AdminController::class, 'storeBusiness'])->name('umkm.store');
    Route::put('/umkm/{business}', [AdminController::class, 'updateBusiness'])->name('umkm.update');
    Route::delete('/umkm/{business}', [AdminController::class, 'deleteBusiness'])->name('umkm.delete');
});
