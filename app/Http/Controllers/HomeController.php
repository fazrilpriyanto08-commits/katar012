<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Aspiration;
use App\Models\Business;
use App\Models\Event;
use App\Models\FinanceTransaction;
use App\Models\Gallery;
use App\Models\HallOfFame;
use App\Models\InventoryItem;
use App\Models\OrganizationStructure;
use App\Models\YouthMember;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Halaman Beranda (Home)
     */
    public function index()
    {
        $featuredArticle = Article::where('is_featured', true)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->first();

        $latestArticles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $upcomingEvents = Event::where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc')
            ->take(4)
            ->get();

        $galleries = Gallery::latest()->take(8)->get();

        $latestAspirations = Aspiration::latest()->take(3)->get();
        $recentHonorees = HallOfFame::latest()->take(4)->get();
        $featuredBusinesses = Business::active()->take(6)->get();

        $totalKasIncome = FinanceTransaction::where('type', 'Pemasukan')->sum('amount');
        $totalKasExpense = FinanceTransaction::where('type', 'Pengeluaran')->sum('amount');
        $kasBalance = $totalKasIncome - $totalKasExpense;

        $stats = [
            'total_youth' => YouthMember::count(),
            'total_events' => Event::count(),
            'total_articles' => Article::count(),
            'total_aspirations' => Aspiration::count(),
            'kas_balance' => $kasBalance,
            'total_honorees' => HallOfFame::count(),
            'total_businesses' => Business::active()->count(),
        ];

        return view('home', compact(
            'featuredArticle',
            'latestArticles',
            'upcomingEvents',
            'galleries',
            'stats',
            'latestAspirations',
            'recentHonorees',
            'featuredBusinesses'
        ));
    }

    /**
     * Halaman Profil & Struktur Organisasi
     */
    public function about()
    {
        $structures = OrganizationStructure::orderBy('order', 'asc')->get();
        return view('about', compact('structures'));
    }

    /**
     * Halaman Agenda Kegiatan
     */
    public function events(Request $request)
    {
        $filter = $request->query('status');

        $query = Event::orderBy('event_date', 'desc');
        if ($filter) {
            $query->where('status', $filter);
        }

        $events = $query->paginate(9);
        return view('events.index', compact('events', 'filter'));
    }

    /**
     * Detail Agenda Kegiatan
     */
    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $otherEvents = Event::where('id', '!=', $event->id)->take(3)->get();
        return view('events.show', compact('event', 'otherEvents'));
    }

    /**
     * Halaman Berita & Informasi
     */
    public function articles(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('q');

        $query = Article::whereNotNull('published_at')->orderBy('published_at', 'desc');

        if ($category) {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(9);
        $categories = ['Berita', 'Pengumuman', 'Kegiatan', 'Artikel'];

        return view('articles.index', compact('articles', 'category', 'search', 'categories'));
    }

    /**
     * Detail Berita & Informasi
     */
    public function articleDetail($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * Halaman Galeri Dokumentasi
     */
    public function gallery(Request $request)
    {
        $category = $request->query('category');
        $query = Gallery::latest();

        if ($category) {
            $query->where('category', $category);
        }

        $galleries = $query->paginate(12);
        $categories = Gallery::select('category')->distinct()->pluck('category');

        return view('gallery', compact('galleries', 'categories', 'category'));
    }

    /**
     * Halaman Form Aspirasi & Kotak Saran Warga
     */
    public function aspiration()
    {
        $recentAspirations = Aspiration::whereIn('status', ['Diproses', 'Selesai'])
            ->latest()
            ->take(5)
            ->get();

        return view('aspiration', compact('recentAspirations'));
    }

    /**
     * Simpan Aspirasi Warga
     */
    public function storeAspiration(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'rt_rw' => 'nullable|string|max:50',
            'category' => 'required|string',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor WhatsApp / HP wajib diisi.',
            'category.required' => 'Pilih kategori aspirasi.',
            'message.required' => 'Pesan aspirasi wajib diisi minimal 10 karakter.',
        ]);

        $validated['rt_rw'] = $validated['rt_rw'] ?? 'RT 012 / RW 05';
        $validated['status'] = 'Menunggu Ditinjau';

        Aspiration::create($validated);

        return redirect()->back()->with('success', 'Terima kasih! Aspirasi atau masukan Anda telah berhasil dikirimkan dan akan segera ditinjau oleh Pengurus Karang Taruna RT 012.');
    }

    /**
     * Halaman Pendaftaran / Sensus Pemuda RT 012
     */
    public function youthRegistration()
    {
        return view('youth-register');
    }

    /**
     * Simpan Pendaftaran Pemuda
     */
    public function storeYouthRegistration(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:100',
            'nickname' => 'nullable|string|max:50',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'birth_date' => 'nullable|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:100',
            'interest' => 'nullable|string|max:150',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib dipilih.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'address.required' => 'Alamat atau nomor rumah wajib diisi.',
        ]);

        $validated['status'] = 'Aktif';

        YouthMember::create($validated);

        return redirect()->back()->with('success', 'Selamat bergabung! Data Anda telah tercatat dalam Database Pemuda Karang Taruna RT 012 RW 05.');
    }

    /**
     * Halaman Transparansi Kas & Anggaran 17-an
     */
    public function finances(Request $request)
    {
        $filter = $request->query('type'); // income, expense, null

        $query = FinanceTransaction::orderBy('transaction_date', 'desc');

        if ($filter && in_array($filter, ['income', 'expense'])) {
            $query->where('type', $filter);
        }

        $transactions = $query->paginate(15);

        $totalIncome = FinanceTransaction::where('type', 'income')->sum('amount');
        $totalExpense = FinanceTransaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('finances', compact('transactions', 'totalIncome', 'totalExpense', 'balance', 'filter'));
    }

    /**
     * Halaman Inventaris / Perlengkapan RT 012 (Publik)
     */
    public function inventory(Request $request)
    {
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

        $items = $query->paginate(12);

        $categories = InventoryItem::select('category')->distinct()->pluck('category');
        $totalItems = InventoryItem::sum('quantity');
        $totalTypes = InventoryItem::count();
        $goodCondition = InventoryItem::where('condition', 'Baik')->count();
        $needRepair = InventoryItem::whereIn('condition', ['Rusak Ringan', 'Rusak Berat'])->count();

        return view('inventory', compact(
            'items', 'categories', 'category', 'condition', 'search',
            'totalItems', 'totalTypes', 'goodCondition', 'needRepair'
        ));
    }

    /**
     * Halaman Hall of Fame / Galeri Prestasi & Kebanggaan RT 012
     */
    public function hallOfFame(Request $request)
    {
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
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $honorees = $query->paginate(9);

        $availableYears = HallOfFame::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $categories = HallOfFame::select('category')->distinct()->pluck('category');

        $stats = [
            'total_honorees' => HallOfFame::count(),
            'total_years' => $availableYears->count(),
            'champions' => HallOfFame::where('award_badge', 'like', '%Juara 1%')->orWhere('award_badge', 'like', '%Emas%')->count(),
        ];

        return view('hall-of-fame', compact('honorees', 'availableYears', 'categories', 'year', 'category', 'search', 'stats'));
    }

    /**
     * Halaman Pasar / Lapak UMKM Warga RT 012
     */
    public function umkm(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('q');

        $query = Business::active()->latest();

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('owner_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $businesses = $query->paginate(12);

        $categories = ['Semua', 'Kuliner', 'Sembako', 'Jasa & Servis', 'Fashion & Busana'];

        $stats = [
            'total' => Business::active()->count(),
            'kuliner' => Business::active()->where('category', 'Kuliner')->count(),
            'sembako' => Business::active()->where('category', 'Sembako')->count(),
            'jasa' => Business::active()->where('category', 'Jasa & Servis')->count(),
        ];

        return view('umkm.index', compact('businesses', 'categories', 'category', 'search', 'stats'));
    }

    /**
     * Pendaftaran Lapak UMKM Warga Mandiri
     */
    public function storeUmkm(Request $request)
    {
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

        $photoUrl = $validated['image'] ?? null;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/uploads'), $fileName);
            $photoUrl = asset('images/uploads/' . $fileName);
        }

        if (!$photoUrl) {
            $photoUrl = match ($validated['category']) {
                'Kuliner' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
                'Sembako' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?auto=format&fit=crop&w=600&q=80',
                'Jasa & Servis' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=600&q=80',
                'Fashion & Busana' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=600&q=80',
                default => 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?auto=format&fit=crop&w=600&q=80'
            };
        }

        Business::create([
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

        return redirect()->route('umkm.index')->with('success', 'Alhamdulillah! Lapak usaha Anda berhasil didaftarkan dan kini telah tayang di Pasar UMKM Warga RT 12 RW 05.');
    }
}
