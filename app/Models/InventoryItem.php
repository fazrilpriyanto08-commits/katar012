<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    /**
     * Barang inventaris / perlengkapan milik RT 012 RW 05
     */
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'unit',
        'condition',
        'storage_location',
        'photo',
        'acquired_date',
        'notes',
    ];

    protected $casts = [
        'acquired_date' => 'date',
        'quantity' => 'integer',
    ];

    /**
     * Daftar kategori barang inventaris
     */
    public static function categories(): array
    {
        return [
            'Tenda & Terpal',
            'Sound System & Elektronik',
            'Dekorasi & Properti',
            'Perlengkapan Lomba',
            'Alat Kebersihan',
            'Olahraga',
            'Meja & Kursi',
            'Dapur & Konsumsi',
            'Penerangan',
            'Lainnya',
        ];
    }

    /**
     * Daftar satuan barang
     */
    public static function units(): array
    {
        return ['Buah', 'Set', 'Lembar', 'Unit', 'Paket', 'Roll', 'Meter', 'Batang', 'Lusin'];
    }

    /**
     * Daftar kondisi barang
     */
    public static function conditions(): array
    {
        return ['Baik', 'Cukup Baik', 'Rusak Ringan', 'Rusak Berat'];
    }

    /**
     * Warna badge berdasarkan kondisi
     */
    public function getConditionColorAttribute(): string
    {
        return match ($this->condition) {
            'Baik' => 'emerald',
            'Cukup Baik' => 'amber',
            'Rusak Ringan' => 'orange',
            'Rusak Berat' => 'rose',
            default => 'stone',
        };
    }
}
