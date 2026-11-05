<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_name',
        'category',
        'description',
        'price_range',
        'address',
        'whatsapp',
        'image',
        'opening_hours',
        'is_verified',
        'status',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    /**
     * Scope for active businesses
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Clean WhatsApp number for international wa.me links
     */
    public function getCleanWhatsappAttribute(): string
    {
        $phone = preg_replace('/[^0-9]/', '', (string)$this->whatsapp);
        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }
        return $phone ?: '6281412357231';
    }

    /**
     * Pre-filled WhatsApp direct chat link
     */
    public function getWhatsappLinkAttribute(): string
    {
        $cleanPhone = $this->clean_whatsapp;
        $pesan = urlencode("Halo {$this->name} ({$this->owner_name}), saya warga RT 12 ingin bertanya/memesan produk Anda lewat Aplikasi Portal RT 12 RW 05.");
        return "https://wa.me/{$cleanPhone}?text={$pesan}";
    }

    /**
     * Category badge style classes
     */
    public function getCategoryBadgeAttribute(): array
    {
        return match ($this->category) {
            'Kuliner' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-800', 'border' => 'border-amber-200', 'icon' => 'fa-utensils'],
            'Sembako' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-800', 'border' => 'border-emerald-200', 'icon' => 'fa-basket-shopping'],
            'Jasa & Servis' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200', 'icon' => 'fa-wrench'],
            'Fashion & Busana' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'border' => 'border-purple-200', 'icon' => 'fa-shirt'],
            default => ['bg' => 'bg-stone-100', 'text' => 'text-stone-800', 'border' => 'border-stone-200', 'icon' => 'fa-shop'],
        };
    }
}
