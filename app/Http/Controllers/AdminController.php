<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Article;
use App\Models\Aspiration;
use App\Models\Business;
use App\Models\Event;
use App\Models\FinanceTransaction;
use App\Models\Gallery;
use App\Models\HallOfFame;
use App\Models\InventoryItem;
use App\Models\OrganizationStructure;
use App\Models\User;
use App\Models\YouthMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Helper untuk upload gambar lokal atau fallback URL
     */
    private function handleImageUpload(Request $request, string $fileKey = 'image_file', ?string $urlKey = 'image', ?string $oldPath = null): ?string
    {
        if ($request->hasFile($fileKey) && $request->file($fileKey)->isValid()) {
            $file = $request->file($fileKey);
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = time() . '_' . Str::random(8) . '.' . $extension;
            $file->move(public_path('images/uploads'), $filename);
            return '/images/uploads/' . $filename;
        }

        if ($urlKey && $request->filled($urlKey)) {
            return $request->input($urlKey);
        }

        return $oldPath;
    }

    /**
     * Memastikan user memiliki hak akses ke modul tertentu
     */
    private function authorizeAccess(string $menu): void
    {
        if (!auth()->check() || !auth()->user()->hasAccessTo($menu)) {
            abort(403, 'Akses Ditolak: Divisi Anda tidak memiliki wewenang untuk modul ini.');
        }
    }

    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        $totalIncome = FinanceTransaction::where('type', 'income')->sum('amount');
        $totalExpense = FinanceTransaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $stats = [
            'total_youth' => YouthMember::count(),
            'total_aspirations' => Aspiration::count(),
            'pending_aspirations' => Aspiration::where('status', 'Menunggu Ditinjau')->count(),
            'total_events' => Event::count(),
            'total_articles' => Article::count(),
            'total_galleries' => Gallery::count(),
            'kas_balance' => $balance,
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'total_inventory' => InventoryItem::sum('quantity'),
            'total_inventory_types' => InventoryItem::count(),
            'total_honorees' => HallOfFame::count(),
            'total_users' => User::count(),
            'inventory_good' => InventoryItem::where('condition', 'Baik')->sum('quantity'),
            'today_logs' => ActivityLog::whereDate('created_at', today())->count(),
        ];

        $recentAspirations = Aspiration::latest()->take(5)->get();
        $recentYouth = YouthMember::latest()->take(5)->get();
        $upcomingEvents = Event::orderBy('event_date', 'asc')->take(4)->get();
        $recentLogs = ActivityLog::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentAspirations', 'recentYouth', 'upcomingEvents', 'recentLogs'));
    }

    /**
     * Manajemen Berita & Pengumuman
     */
    public function articles()
    {
        $this->authorizeAccess('articles');
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function createArticle()
    {
        $this->authorizeAccess('articles');
        return view('admin.articles.create');
    }

    public function storeArticle(Request $request)
    {
        $this->authorizeAccess('articles');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240', // Maks 10MB
            'author' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['image'] = $this->handleImageUpload($request, 'image_file', 'image');
        $validated['author'] = $validated['author'] ?: 'Pengurus RT 012';
        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(1000, 9999);
        $validated['published_at'] = now();
        $validated['is_featured'] = $request->has('is_featured');

        Article::create($validated);
        ActivityLog::record('TAMBAH', 'Berita & Informasi', "Mempublikasikan artikel berita: '{$validated['title']}' (Kategori: {$validated['category']})");

        return redirect()->route('admin.articles.index')->with('success', 'Berita / Pengumuman berhasil dipublikasikan!');
    }

    public function editArticle(Article $article)
    {
        $this->authorizeAccess('articles');
        return view('admin.articles.edit', compact('article'));
    }

    public function updateArticle(Request $request, Article $article)
    {
        $this->authorizeAccess('articles');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
            'author' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['image'] = $this->handleImageUpload($request, 'image_file', 'image', $article->image);
        $validated['author'] = $validated['author'] ?: 'Pengurus RT 012';
        $validated['is_featured'] = $request->has('is_featured');

        $article->update($validated);
        ActivityLog::record('UPDATE', 'Berita & Informasi', "Memperbarui artikel berita: '{$validated['title']}'");

        return redirect()->route('admin.articles.index')->with('success', 'Berita / Pengumuman berhasil diperbarui!');
    }

    public function deleteArticle(Article $article)
    {
        $this->authorizeAccess('articles');
        $title = $article->title;
        $article->delete();
        ActivityLog::record('HAPUS', 'Berita & Informasi', "Menghapus artikel berita: '{$title}'");

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Manajemen Agenda Kegiatan
     */
    public function events()
    {
        $this->authorizeAccess('events');
        $events = Event::orderBy('event_date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function createEvent()
    {
        $this->authorizeAccess('events');
        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        $this->authorizeAccess('events');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
            'status' => 'required|in:Akan Datang,Sedang Berlangsung,Selesai',
            'organizer' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
        ]);

        $validated['image'] = $this->handleImageUpload($request, 'image_file', 'image');
        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(1000, 9999);
        $validated['organizer'] = $validated['organizer'] ?: 'Karang Taruna RT 012';

        Event::create($validated);
        ActivityLog::record('TAMBAH', 'Agenda Kegiatan', "Menjadwalkan kegiatan baru: '{$validated['title']}' pada {$validated['event_date']} ({$validated['status']})");

        return redirect()->route('admin.events.index')->with('success', 'Agenda kegiatan berhasil ditambahkan!');
    }

    public function editEvent(Event $event)
    {
        $this->authorizeAccess('events');
        return view('admin.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, Event $event)
    {
        $this->authorizeAccess('events');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'event_date' => 'required|date',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
            'status' => 'required|in:Akan Datang,Sedang Berlangsung,Selesai',
            'organizer' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:10240',
        ]);

        $validated['image'] = $this->handleImageUpload($request, 'image_file', 'image', $event->image);
        $validated['organizer'] = $validated['organizer'] ?: 'Karang Taruna RT 012';

        $event->update($validated);
        ActivityLog::record('UPDATE', 'Agenda Kegiatan', "Memperbarui agenda kegiatan: '{$validated['title']}' (Status: {$validated['status']})");

        return redirect()->route('admin.events.index')->with('success', 'Agenda kegiatan berhasil diperbarui!');
    }

    public function deleteEvent(Event $event)
    {
        $this->authorizeAccess('events');
        $title = $event->title;
        $event->delete();
        ActivityLog::record('HAPUS', 'Agenda Kegiatan', "Menghapus agenda kegiatan: '{$title}'");

        return redirect()->route('admin.events.index')->with('success', 'Agenda kegiatan berhasil dihapus.');
    }

    /**
     * Manajemen Galeri
     */
    public function galleries()
    {
        $this->authorizeAccess('galleries');
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function storeGallery(Request $request)
    {
        $this->authorizeAccess('galleries');
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image_file' => 'nullable|image|max:10240',
            'image_url' => 'nullable|string',
            'description' => 'nullable|string',
            'activity_date' => 'nullable|date',
        ]);

        $imageUrl = $this->handleImageUpload($request, 'image_file', 'image_url');

        if (!$imageUrl) {
            return back()->withErrors(['image_file' => 'Silakan pilih file foto dari HP/komputer atau masukkan link URL gambar.'])->withInput();
        }

        Gallery::create([
            'title' => $request->title,
            'category' => $request->category,
            'image_url' => $imageUrl,
            'description' => $request->description,
            'activity_date' => $request->activity_date,
        ]);
        ActivityLog::record('TAMBAH', 'Galeri Foto', "Mengunggah foto dokumentasi: '{$request->title}' (Kategori: {$request->category})");

        return redirect()->route('admin.galleries.index')->with('success', 'Foto dokumentasi berhasil ditambahkan!');
    }

    public function deleteGallery(Gallery $gallery)
    {
        $this->authorizeAccess('galleries');
        $title = $gallery->title;
        $gallery->delete();
        ActivityLog::record('HAPUS', 'Galeri Foto', "Menghapus foto dokumentasi: '{$title}'");

        return redirect()->route('admin.galleries.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }

    /**
     * Manajemen Aspirasi Warga
     */
    public function aspirations()
    {
        $this->authorizeAccess('aspirations');
        $aspirations = Aspiration::latest()->paginate(15);
        return view('admin.aspirations.index', compact('aspirations'));
    }

    public function updateAspirationStatus(Request $request, Aspiration $aspiration)
    {
        $this->authorizeAccess('aspirations');
        $validated = $request->validate([
            'status' => 'required|in:Menunggu Ditinjau,Diproses,Selesai',
            'admin_notes' => 'nullable|string',
        ]);

        $oldStatus = $aspiration->status;
        $aspiration->update($validated);
        ActivityLog::record('STATUS', 'Aspirasi Warga', "Mengubah status aspirasi '{$aspiration->name}' dari '{$oldStatus}' ke '{$validated['status']}'");

        return redirect()->route('admin.aspirations.index')->with('success', 'Status aspirasi warga berhasil diperbarui!');
    }

    public function deleteAspiration(Aspiration $aspiration)
    {
        $this->authorizeAccess('aspirations');
        $name = $aspiration->name;
        $aspiration->delete();
        ActivityLog::record('HAPUS', 'Aspirasi Warga', "Menghapus data aspirasi dari warga: '{$name}'");

        return redirect()->route('admin.aspirations.index')->with('success', 'Aspirasi warga berhasil dihapus.');
    }

    /**
     * Database Pemuda RT 012
     */
    public function youthMembers()
    {
        $this->authorizeAccess('youth');
        $members = YouthMember::latest()->paginate(15);
        return view('admin.youth.index', compact('members'));
    }

    public function deleteYouthMember(YouthMember $member)
    {
        $this->authorizeAccess('youth');
        $name = $member->full_name;
        $member->delete();
        ActivityLog::record('HAPUS', 'Database Pemuda', "Menghapus data anggota pemuda: '{$name}'");

        return redirect()->route('admin.youth.index')->with('success', 'Data anggota pemuda berhasil dihapus.');
    }

    /**
     * Struktur Pengurus
     */
    public function structures()
    {
        $this->authorizeAccess('structures');
        $structures = OrganizationStructure::orderBy('order', 'asc')->get();
        return view('admin.structures.index', compact('structures'));
    }

    public function storeStructure(Request $request)
    {
        $this->authorizeAccess('structures');
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'division' => 'required|string|max:100',
            'photo' => 'nullable|string',
            'photo_file' => 'nullable|image|max:10240',
            'order' => 'nullable|integer',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['photo'] = $this->handleImageUpload($request, 'photo_file', 'photo');
        $validated['order'] = $validated['order'] ?? 99;

        OrganizationStructure::create($validated);
        ActivityLog::record('TAMBAH', 'Struktur Pengurus', "Menambahkan susunan pengurus: '{$validated['name']}' ({$validated['position']} - {$validated['division']})");

        return redirect()->route('admin.structures.index')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function deleteStructure(OrganizationStructure $structure)
    {
        $this->authorizeAccess('structures');
        $name = $structure->name;
        $structure->delete();
        ActivityLog::record('HAPUS', 'Struktur Pengurus', "Menghapus pengurus: '{$name}'");

        return redirect()->route('admin.structures.index')->with('success', 'Pengurus berhasil dihapus.');
    }

    /**
     * Manajemen Kas & Keuangan 17-an
     */
    public function finances()
    {
        $this->authorizeAccess('finances');
        $transactions = FinanceTransaction::orderBy('transaction_date', 'desc')->paginate(15);
        $totalIncome = FinanceTransaction::where('type', 'income')->sum('amount');
        $totalExpense = FinanceTransaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('admin.finances.index', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function storeFinance(Request $request)
    {
        $this->authorizeAccess('finances');
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:100',
            'amount' => 'required|numeric|min:1000',
            'transaction_date' => 'required|date',
            'proof_file' => 'nullable|image|max:10240',
            'notes' => 'nullable|string',
        ]);

        $validated['proof_image'] = $this->handleImageUpload($request, 'proof_file', null);

        FinanceTransaction::create($validated);
        $typeLabel = $validated['type'] === 'income' ? 'Pemasukan' : 'Pengeluaran';
        ActivityLog::record('TAMBAH', 'Kas Keuangan', "Mencatat transaksi {$typeLabel}: '{$validated['title']}' sebesar Rp " . number_format($validated['amount'], 0, ',', '.'));

        return redirect()->route('admin.finances.index')->with('success', 'Catatan kas / anggaran berhasil disimpan!');
    }

    public function deleteFinance(FinanceTransaction $finance)
    {
        $this->authorizeAccess('finances');
        $title = $finance->title;
        $amount = number_format($finance->amount, 0, ',', '.');
        $finance->delete();
        ActivityLog::record('HAPUS', 'Kas Keuangan', "Menghapus transaksi kas: '{$title}' senilai Rp {$amount}");

        return redirect()->route('admin.finances.index')->with('success', 'Transaksi kas berhasil dihapus.');
    }

    /**
     * Manajemen Inventaris / Perlengkapan Barang RT 012
     */
    public function inventory(Request $request)
    {
        $this->authorizeAccess('inventory');
        $category = $request->query('category');
        $condition = $request->query('condition');
        $search = $request->query('q');

        $query = InventoryItem::orderBy('category')->orderBy('name');

        if ($category) {
            $query->where('category', $category);
        }

        if ($condition) {
            $query->where('condition', $condition);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%")
                  ->orWhere('storage_location', 'like', "%{$search}%");
            });
        }

        $items = $query->paginate(15);

        $totalItems = InventoryItem::sum('quantity');
        $totalTypes = InventoryItem::count();
        $goodCondition = InventoryItem::where('condition', 'Baik')->count();
        $needRepair = InventoryItem::whereIn('condition', ['Rusak Ringan', 'Rusak Berat'])->count();

        $categories = InventoryItem::categories();
        $units = InventoryItem::units();
        $conditions = InventoryItem::conditions();

        return view('admin.inventory.index', compact(
            'items', 'totalItems', 'totalTypes', 'goodCondition', 'needRepair',
            'categories', 'units', 'conditions', 'category', 'condition', 'search'
        ));
    }

    public function storeInventory(Request $request)
    {
        $this->authorizeAccess('inventory');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'condition' => 'required|in:Baik,Cukup Baik,Rusak Ringan,Rusak Berat',
            'storage_location' => 'nullable|string|max:255',
            'photo_file' => 'nullable|image|max:10240',
            'acquired_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['photo'] = $this->handleImageUpload($request, 'photo_file', null);

        InventoryItem::create($validated);
        ActivityLog::record('TAMBAH', 'Inventaris Barang', "Menambahkan aset barang: {$validated['quantity']} {$validated['unit']} '{$validated['name']}' (Kondisi: {$validated['condition']}, Lokasi: " . ($validated['storage_location'] ?? 'Gudang Balai') . ")");

        return redirect()->route('admin.inventory.index')->with('success', 'Barang inventaris berhasil ditambahkan!');
    }

    public function updateInventory(Request $request, InventoryItem $item)
    {
        $this->authorizeAccess('inventory');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'condition' => 'required|in:Baik,Cukup Baik,Rusak Ringan,Rusak Berat',
            'storage_location' => 'nullable|string|max:255',
            'photo_file' => 'nullable|image|max:10240',
            'acquired_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['photo'] = $this->handleImageUpload($request, 'photo_file', null, $item->photo);

        $item->update($validated);
        ActivityLog::record('UPDATE', 'Inventaris Barang', "Memperbarui data inventaris '{$item->name}' (Stok: {$validated['quantity']} {$validated['unit']}, Kondisi: {$validated['condition']})");

        return redirect()->route('admin.inventory.index')->with('success', 'Data barang inventaris berhasil diperbarui!');
    }

    public function deleteInventory(InventoryItem $item)
    {
        $this->authorizeAccess('inventory');
        $name = $item->name;
        $item->delete();
        ActivityLog::record('HAPUS', 'Inventaris Barang', "Menghapus barang inventaris: '{$name}'");

        return redirect()->route('admin.inventory.index')->with('success', 'Barang inventaris berhasil dihapus.');
    }

    /**
     * Manajemen Hall of Fame / Tokoh & Juara Berprestasi
     */
    public function hallOfFame(Request $request)
    {
        $this->authorizeAccess('hall_of_fame');
        $year = $request->query('year');
        $category = $request->query('category');
        $search = $request->query('q');

        $query = HallOfFame::orderBy('year', 'desc')->orderBy('order', 'asc')->orderBy('id', 'desc');

        if ($year) {
            $query->where('year', $year);
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $honorees = $query->paginate(15);
        $categories = HallOfFame::categories();
        $badges = HallOfFame::badges();
        $availableYears = HallOfFame::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('admin.hall-of-fame.index', compact('honorees', 'categories', 'badges', 'availableYears', 'year', 'category', 'search'));
    }

    public function storeHallOfFame(Request $request)
    {
        $this->authorizeAccess('hall_of_fame');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:2099',
            'award_badge' => 'required|string|max:100',
            'photo_file' => 'nullable|image|max:10240',
            'photo_url' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $validated['photo'] = $this->handleImageUpload($request, 'photo_file', 'photo_url');
        $validated['order'] = $validated['order'] ?? 0;

        HallOfFame::create($validated);
        ActivityLog::record('TAMBAH', 'Hall of Fame', "Menambahkan tokoh/prestasi: '{$validated['name']}' - {$validated['title']} ({$validated['award_badge']})");

        return redirect()->route('admin.hall-of-fame.index')->with('success', 'Data Hall of Fame berhasil ditambahkan!');
    }

    public function updateHallOfFame(Request $request, HallOfFame $item)
    {
        $this->authorizeAccess('hall_of_fame');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:2099',
            'award_badge' => 'required|string|max:100',
            'photo_file' => 'nullable|image|max:10240',
            'photo_url' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $validated['photo'] = $this->handleImageUpload($request, 'photo_file', 'photo_url', $item->photo);
        $validated['order'] = $validated['order'] ?? 0;

        $item->update($validated);
        ActivityLog::record('UPDATE', 'Hall of Fame', "Memperbarui data Hall of Fame: '{$item->name}' - {$validated['title']}");

        return redirect()->route('admin.hall-of-fame.index')->with('success', 'Data Hall of Fame berhasil diperbarui!');
    }

    public function deleteHallOfFame(HallOfFame $item)
    {
        $this->authorizeAccess('hall_of_fame');
        $name = $item->name;
        $item->delete();
        ActivityLog::record('HAPUS', 'Hall of Fame', "Menghapus data Hall of Fame: '{$name}'");

        return redirect()->route('admin.hall-of-fame.index')->with('success', 'Data Hall of Fame berhasil dihapus.');
    }

    /**
     * Manajemen & Registrasi Akun Pengurus per Divisi
     */
    public function users(Request $request)
    {
        $this->authorizeAccess('users');
        $role = $request->query('role');
        $search = $request->query('q');

        $query = User::latest();

        if ($role) {
            $query->where('role', $role);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15);
        $roles = User::availableRoles();

        return view('admin.users.index', compact('users', 'roles', 'role', 'search'));
    }

    public function storeUser(Request $request)
    {
        $this->authorizeAccess('users');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|in:admin,ketua,wakil,acara,sekertaris,perlap,dokum,bendahara',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar untuk akun pengurus lain.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = true;

        User::create($validated);
        $roleLabel = User::availableRoles()[$validated['role']]['label'] ?? $validated['role'];
        ActivityLog::record('TAMBAH', 'Akun Pengurus', "Mendaftarkan akun baru: '{$validated['name']}' ({$validated['email']}) sebagai {$roleLabel}");

        return redirect()->route('admin.users.index')->with('success', 'Akun pengurus (' . $roleLabel . ') berhasil didaftarkan!');
    }

    public function updateUser(Request $request, User $user)
    {
        $this->authorizeAccess('users');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,ketua,wakil,acara,sekertaris,perlap,dokum,bendahara',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        ActivityLog::record('UPDATE', 'Akun Pengurus', "Memperbarui profil akun pengurus: '{$user->name}' ({$user->email})");

        return redirect()->route('admin.users.index')->with('success', 'Data akun pengurus berhasil diperbarui!');
    }

    public function deleteUser(User $user)
    {
        $this->authorizeAccess('users');
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $name = $user->name;
        $email = $user->email;
        $user->delete();
        ActivityLog::record('HAPUS', 'Akun Pengurus', "Menghapus akun pengurus: '{$name}' ({$email})");

        return redirect()->route('admin.users.index')->with('success', 'Akun pengurus berhasil dihapus.');
    }

    /**
     * Log Aktivitas Pengurus (Audit Trail Khusus Admin)
     */
    public function activityLogs(Request $request)
    {
        $this->authorizeAccess('activity_logs');

        $role = $request->query('role');
        $action = $request->query('action');
        $module = $request->query('module');
        $search = $request->query('q');

        $query = ActivityLog::with('user')->latest();

        if ($role) {
            $query->where('user_role', $role);
        }

        if ($action) {
            $query->where('action', $action);
        }

        if ($module) {
            $query->where('module', $module);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('user_name', 'like', "%{$search}%")
                  ->orWhere('details', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(20)->withQueryString();
        $roles = User::availableRoles();

        $modules = [
            'Kas Keuangan',
            'Inventaris Barang',
            'Berita & Informasi',
            'Agenda Kegiatan',
            'Galeri Foto',
            'Aspirasi Warga',
            'Database Pemuda',
            'Struktur Pengurus',
            'Hall of Fame',
            'Akun Pengurus',
            'Autentikasi',
        ];

        $actions = [
            'TAMBAH' => 'Menambahkan',
            'UPDATE' => 'Memperbarui',
            'HAPUS' => 'Menghapus',
            'STATUS' => 'Ubah Status',
            'LOGIN' => 'Login / Sesi',
        ];

        $metrics = [
            'total' => ActivityLog::count(),
            'today' => ActivityLog::whereDate('created_at', today())->count(),
            'updates' => ActivityLog::whereIn('action', ['UPDATE', 'STATUS'])->count(),
            'deletes' => ActivityLog::where('action', 'HAPUS')->count(),
            'creates' => ActivityLog::where('action', 'TAMBAH')->count(),
            'logins' => ActivityLog::where('action', 'LOGIN')->count(),
        ];

        return view('admin.activity_logs.index', compact(
            'logs', 'roles', 'modules', 'actions', 'role', 'action', 'module', 'search', 'metrics'
        ));
    }

    public function clearActivityLogs()
    {
        $this->authorizeAccess('activity_logs');
        ActivityLog::truncate();
        ActivityLog::record('HAPUS', 'Log Aktivitas', 'Membersihkan seluruh riwayat log aktivitas pengurus.');

        return redirect()->route('admin.activity-logs.index')->with('success', 'Seluruh riwayat log aktivitas berhasil dibersihkan.');
    }

    /**
     * ==========================================
     * MANAJEMEN LAPAK UMKM & USAHA WARGA RT 012
     * ==========================================
     */
    public function businesses(Request $request)
    {
        $this->authorizeAccess('umkm');

        $category = $request->query('category');
        $status = $request->query('status');
        $search = $request->query('q');

        $query = Business::orderBy('id', 'desc');

        if ($category) {
            $query->where('category', $category);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('owner_name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $businesses = $query->paginate(15);

        $categories = ['Kuliner', 'Sembako', 'Jasa & Servis', 'Fashion & Busana', 'Lainnya'];

        $metrics = [
            'total' => Business::count(),
            'active' => Business::where('status', 'active')->count(),
            'kuliner' => Business::where('category', 'Kuliner')->count(),
            'sembako' => Business::where('category', 'Sembako')->count(),
            'jasa' => Business::where('category', 'Jasa & Servis')->count(),
        ];

        return view('admin.umkm.index', compact('businesses', 'categories', 'category', 'status', 'search', 'metrics'));
    }

    public function storeBusiness(Request $request)
    {
        $this->authorizeAccess('umkm');

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:100',
            'category' => 'required|string',
            'description' => 'required|string|max:500',
            'price_range' => 'nullable|string|max:100',
            'address' => 'required|string|max:200',
            'whatsapp' => 'required|string|max:25',
            'opening_hours' => 'nullable|string|max:100',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $photoUrl = $this->handleImageUpload($request, 'image_file', 'image');

        if (!$photoUrl) {
            $photoUrl = match ($validated['category']) {
                'Kuliner' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
                'Sembako' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?auto=format&fit=crop&w=600&q=80',
                'Jasa & Servis' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=600&q=80',
                'Fashion & Busana' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=600&q=80',
                default => 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?auto=format&fit=crop&w=600&q=80'
            };
        }

        $business = Business::create([
            'name' => $validated['name'],
            'owner_name' => $validated['owner_name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price_range' => $validated['price_range'] ?: 'Hubungi Penjual',
            'address' => $validated['address'],
            'whatsapp' => $validated['whatsapp'],
            'opening_hours' => $validated['opening_hours'] ?: 'Buka Setiap Hari',
            'image' => $photoUrl,
            'is_verified' => true,
            'status' => 'active',
        ]);

        ActivityLog::record('TAMBAH', 'Lapak UMKM Warga', "Menambahkan lapak usaha: {$business->name} milik {$business->owner_name}");

        return redirect()->route('admin.umkm.index')->with('success', 'Lapak UMKM Warga berhasil ditambahkan ke direktori.');
    }

    public function updateBusiness(Request $request, Business $business)
    {
        $this->authorizeAccess('umkm');

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:100',
            'category' => 'required|string',
            'description' => 'required|string|max:500',
            'price_range' => 'nullable|string|max:100',
            'address' => 'required|string|max:200',
            'whatsapp' => 'required|string|max:25',
            'opening_hours' => 'nullable|string|max:100',
            'status' => 'required|string|in:active,inactive,pending',
            'image' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $photoUrl = $this->handleImageUpload($request, 'image_file', 'image', $business->image);

        $business->update([
            'name' => $validated['name'],
            'owner_name' => $validated['owner_name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'price_range' => $validated['price_range'] ?: 'Hubungi Penjual',
            'address' => $validated['address'],
            'whatsapp' => $validated['whatsapp'],
            'opening_hours' => $validated['opening_hours'] ?: 'Buka Setiap Hari',
            'image' => $photoUrl,
            'status' => $validated['status'],
        ]);

        ActivityLog::record('UPDATE', 'Lapak UMKM Warga', "Memperbarui rincian lapak: {$business->name}");

        return redirect()->route('admin.umkm.index')->with('success', 'Data lapak UMKM berhasil diperbarui.');
    }

    public function deleteBusiness(Business $business)
    {
        $this->authorizeAccess('umkm');

        $name = $business->name;
        $business->delete();

        ActivityLog::record('HAPUS', 'Lapak UMKM Warga', "Menghapus lapak usaha: {$name}");

        return redirect()->route('admin.umkm.index')->with('success', "Lapak {$name} berhasil dihapus dari direktori.");
    }
}
