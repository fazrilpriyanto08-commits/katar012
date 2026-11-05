<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultUsers = [
            [
                'name' => 'Administrator Sistem RT 012',
                'email' => 'admin@katar012.id',
                'role' => 'admin',
                'phone' => '081234567800',
            ],
            [
                'name' => 'Muhammad Rizky Pratama (Ketua)',
                'email' => 'ketua@katar012.id',
                'role' => 'ketua',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Dimas Surya Wicaksono (Wakil)',
                'email' => 'wakil@katar012.id',
                'role' => 'wakil',
                'phone' => '081234567891',
            ],
            [
                'name' => 'Siti Nur Aisyah (Sekertaris)',
                'email' => 'sekertaris@katar012.id',
                'role' => 'sekertaris',
                'phone' => '081234567892',
            ],
            [
                'name' => 'Anisa Rahmawati (Bendahara)',
                'email' => 'bendahara@katar012.id',
                'role' => 'bendahara',
                'phone' => '081234567893',
            ],
            [
                'name' => 'Fajar Nugraha (Divisi Acara)',
                'email' => 'acara@katar012.id',
                'role' => 'acara',
                'phone' => '081234567894',
            ],
            [
                'name' => 'Reza Aditya (Divisi Perlap)',
                'email' => 'perlap@katar012.id',
                'role' => 'perlap',
                'phone' => '081234567897',
            ],
            [
                'name' => 'Bella Oktavia (Divisi Dokum)',
                'email' => 'dokum@katar012.id',
                'role' => 'dokum',
                'phone' => '081234567895',
            ],
        ];

        foreach ($defaultUsers as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('password123'),
                    'role' => $u['role'],
                    'phone' => $u['phone'] ?? null,
                    'is_active' => true,
                ]
            );
        }
    }
}
