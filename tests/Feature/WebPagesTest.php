<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WebPagesTest extends TestCase
{
    public function test_public_pages_can_be_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('KARANG TARUNA');

        $response = $this->get('/profil');
        $response->assertStatus(200);
        $response->assertSee('Visi Kami');

        $response = $this->get('/agenda');
        $response->assertStatus(200);

        $response = $this->get('/berita');
        $response->assertStatus(200);

        $response = $this->get('/galeri');
        $response->assertStatus(200);

        $response = $this->get('/aspirasi-warga');
        $response->assertStatus(200);
        $response->assertSee('Kirim Aspirasi');

        $response = $this->get('/gabung-pemuda');
        $response->assertStatus(200);
        $response->assertSee('Sensus & Pendaftaran');

        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Portal Masuk Pengurus');
    }

    public function test_warga_can_submit_aspiration(): void
    {
        $response = $this->post('/aspirasi-warga', [
            'name' => 'Warga RT 012',
            'phone' => '081299887766',
            'rt_rw' => 'RT 012 / RW 05',
            'category' => 'Saran',
            'message' => 'Mohon ditambahkan tempat sampah pilah di lapangan olahraga.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('aspirations', [
            'name' => 'Warga RT 012',
            'phone' => '081299887766',
        ]);
    }

    public function test_youth_can_register(): void
    {
        $response = $this->post('/gabung-pemuda', [
            'full_name' => 'Pemuda Baru',
            'nickname' => 'Baru',
            'gender' => 'Laki-laki',
            'birth_date' => '2005-01-01',
            'phone' => '081211112222',
            'address' => 'RT 012 / RW 05 Gang 3 No. 5',
            'occupation' => 'Mahasiswa',
            'interest' => 'Olahraga & IT',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('youth_members', [
            'full_name' => 'Pemuda Baru',
            'phone' => '081211112222',
        ]);
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::first();
        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Ringkasan Statistik');
    }
}
