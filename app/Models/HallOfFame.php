<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HallOfFame extends Model
{
    protected $fillable = [
        'name',
        'title',
        'category',
        'year',
        'award_badge',
        'photo',
        'description',
        'order',
    ];

    protected $casts = [
        'year' => 'integer',
        'order' => 'integer',
    ];

    public static function categories(): array
    {
        return [
            '17-an & Lomba Rimba',
            'Olahraga & E-Sport',
            'Seni & Kreativitas',
            'Akademik & Pendidikan',
            'Tokoh Inspiratif Warga',
            'Aksi Sosial & Lingkungan',
        ];
    }

    public static function badges(): array
    {
        return [
            'Juara 1 🏆',
            'Juara 2 🥈',
            'Juara 3 🥉',
            'Juara Favorit ⭐',
            'Medali Emas 🥇',
            'Tokoh Teladan 🎖️',
            'Penghargaan Khusus 🌟',
        ];
    }
}
