<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_role',
        'action',
        'module',
        'description',
        'details',
        'ip_address',
        'user_agent',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Catat aktivitas pengurus ke dalam database
     */
    public static function record(string $action, string $module, string $description, ?string $details = null): ?self
    {
        try {
            $user = auth()->user();

            return self::create([
                'user_id' => $user?->id,
                'user_name' => $user?->name ?? 'Sistem / Anonim',
                'user_role' => $user?->role ?? 'tamu',
                'action' => strtoupper($action),
                'module' => $module,
                'description' => $description,
                'details' => $details,
                'ip_address' => request()->ip(),
                'user_agent' => substr(request()->userAgent() ?? '', 0, 500),
            ]);
        } catch (\Throwable $e) {
            // Jangan gagalkan proses utama jika terjadi error logging
            report($e);
            return null;
        }
    }

    /**
     * Badge tampilan aksi (TAMBAH, UPDATE, HAPUS, STATUS)
     */
    public function getActionBadgeAttribute(): array
    {
        return match ($this->action) {
            'TAMBAH' => [
                'label' => 'Menambahkan',
                'icon' => 'fa-plus',
                'bg' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
            ],
            'UPDATE' => [
                'label' => 'Memperbarui',
                'icon' => 'fa-pen-to-square',
                'bg' => 'bg-blue-100 text-blue-800 border-blue-200',
            ],
            'HAPUS' => [
                'label' => 'Menghapus',
                'icon' => 'fa-trash',
                'bg' => 'bg-rose-100 text-rose-800 border-rose-200',
            ],
            'STATUS' => [
                'label' => 'Ubah Status',
                'icon' => 'fa-rotate',
                'bg' => 'bg-amber-100 text-amber-800 border-amber-200',
            ],
            'LOGIN' => [
                'label' => 'Masuk Sesi',
                'icon' => 'fa-right-to-bracket',
                'bg' => 'bg-stone-100 text-stone-700 border-stone-200',
            ],
            default => [
                'label' => $this->action,
                'icon' => 'fa-circle-info',
                'bg' => 'bg-stone-100 text-stone-700 border-stone-200',
            ],
        };
    }

    /**
     * Badge jabatan user saat melakukan aksi
     */
    public function getRoleBadgeAttribute(): string
    {
        $roles = User::availableRoles();
        return $roles[$this->user_role]['badge'] ?? ucfirst($this->user_role ?? 'Pengurus');
    }
}
