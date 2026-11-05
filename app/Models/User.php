<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Daftar divisi / role pengurus yang tersedia
     */
    public static function availableRoles(): array
    {
        return [
            'admin' => [
                'label' => 'Administrator',
                'badge' => '⚡ Admin',
                'color' => 'red',
                'desc' => 'Akses penuh seluruh modul sistem & kelola akun pengurus',
            ],
            'ketua' => [
                'label' => 'Ketua Pemuda',
                'badge' => '👑 Ketua',
                'color' => 'emerald',
                'desc' => 'Akses kelola seluruh modul (kecuali keuangan & kelola akun)',
            ],
            'wakil' => [
                'label' => 'Wakil Ketua',
                'badge' => '🤝 Wakil',
                'color' => 'teal',
                'desc' => 'Akses kelola seluruh modul (kecuali keuangan & kelola akun)',
            ],
            'sekertaris' => [
                'label' => 'Sekertaris',
                'badge' => '📝 Sekertaris',
                'color' => 'blue',
                'desc' => 'Kelola berita/informasi, aspirasi warga, & database pemuda',
            ],
            'bendahara' => [
                'label' => 'Bendahara',
                'badge' => '💰 Bendahara',
                'color' => 'amber',
                'desc' => 'Kelola transparansi kas & anggaran keuangan 17-an',
            ],
            'acara' => [
                'label' => 'Divisi Acara',
                'badge' => '🎪 Acara',
                'color' => 'indigo',
                'desc' => 'Kelola berita/informasi & agenda kegiatan',
            ],
            'perlap' => [
                'label' => 'Divisi Perlap',
                'badge' => '📦 Perlap',
                'color' => 'orange',
                'desc' => 'Kelola barang-barang inventaris & aset RT',
            ],
            'dokum' => [
                'label' => 'Divisi Dokum',
                'badge' => '📸 Dokum',
                'color' => 'purple',
                'desc' => 'Kelola dokumentasi galeri foto & hall of fame',
            ],
        ];
    }

    /**
     * Label jabatan rapi
     */
    public function getRoleLabelAttribute(): string
    {
        $roles = self::availableRoles();
        return $roles[$this->role]['label'] ?? ucfirst($this->role);
    }

    /**
     * Badge tampilan jabatan
     */
    public function getRoleBadgeAttribute(): string
    {
        $roles = self::availableRoles();
        return $roles[$this->role]['badge'] ?? ucfirst($this->role);
    }

    /**
     * Cek apakah user memiliki hak akses menu tertentu
     * 
     * Aturan Hak Akses:
     * - admin: Bisa akses SEMUA modul tanpa batasan.
     * - ketua & wakil: Bisa kelola semua konten KECUALI keuangan ('finances') & kelola akun ('users').
     * - acara: Cuma bisa edit informasi ('articles') dan agenda kegiatan ('events').
     * - sekertaris: Cuma bisa edit berita ('articles'), aspirasi warga ('aspirations'), dan database pemuda ('youth').
     * - perlap: Cuma bisa edit barang inventaris ('inventory').
     * - dokum: Cuma bisa edit galeri foto ('galleries') dan hall of fame ('hall_of_fame').
     * - bendahara: Cuma bisa edit anggaran keuangan ('finances').
     */
    public function hasAccessTo(string $menu): bool
    {
        // 1. Admin bisa semuanya yang ada di dashboard
        if (in_array($this->role, ['admin', 'superadmin'])) {
            return true;
        }

        // 2. Ketua & Wakil bisa semua KECUALI keuangan, kelola akun pengurus, dan log aktivitas
        if (in_array($this->role, ['ketua', 'wakil'])) {
            return !in_array($menu, ['finances', 'users', 'activity_logs']);
        }

        // 3. Divisi Acara: informasi (berita) dan agenda kegiatan
        if ($this->role === 'acara') {
            return in_array($menu, ['articles', 'events']);
        }

        // 4. Sekertaris: berita, aspirasi warga, database pemuda, dan lapak UMKM warga
        if ($this->role === 'sekertaris') {
            return in_array($menu, ['articles', 'aspirations', 'youth', 'umkm']);
        }

        // 5. Divisi Perlap: barang-barang inventaris
        if ($this->role === 'perlap') {
            return in_array($menu, ['inventory']);
        }

        // 6. Divisi Dokum: galeri foto dan hall of fame
        if ($this->role === 'dokum') {
            return in_array($menu, ['galleries', 'hall_of_fame']);
        }

        // 7. Bendahara: anggaran keuangan
        if ($this->role === 'bendahara') {
            return in_array($menu, ['finances']);
        }

        return false;
    }
}
