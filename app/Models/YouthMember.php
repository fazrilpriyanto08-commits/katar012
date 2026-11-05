<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'nickname',
        'gender',
        'birth_date',
        'phone',
        'address',
        'occupation',
        'interest',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
