<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Business::count() > 0) {
            return;
        }

        Business::create([
            'name' => 'Warung Nasi Uduk & Lontong Sayur Bu Siti',
            'owner_name' => 'Ibu Siti Rohmah',
            'category' => 'Kuliner',
            'description' => 'Menyediakan nasi uduk Betawi pulen, lontong sayur labu siam, semur jengkol, tahu tempe bacem, telur balado dan aneka gorengan hangat setiap pagi.',
            'price_range' => 'Rp 10.000 - Rp 25.000',
            'address' => 'Gg. H. Saatun RT 012/05 No. 12',
            'whatsapp' => '081412357231',
            'opening_hours' => '06:00 - 11:00 WIB (Pagi)',
            'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80',
            'is_verified' => true,
            'status' => 'active'
        ]);

        Business::create([
            'name' => 'Toko Sembako Berkah RT 12',
            'owner_name' => 'Bapak H. Mahfudz',
            'category' => 'Sembako',
            'description' => 'Sedia beras pandan wangi, minyak goreng, telur ayam segar, gula, tepung, mie instan, gas elpiji 3kg & galon air mineral. Siap antar ke rumah warga RT 12.',
            'price_range' => 'Harga Grosir & Eceran Warga',
            'address' => 'Gg. H. Saatun RT 012 No. 04 (Dekat Pos Ronda)',
            'whatsapp' => '081412357231',
            'opening_hours' => '07:00 - 21:00 WIB',
            'image' => 'https://images.unsplash.com/photo-1578916171728-46686eac8d58?auto=format&fit=crop&w=600&q=80',
            'is_verified' => true,
            'status' => 'active'
        ]);

        Business::create([
            'name' => 'Laundry Express Kiloan Teh Rina',
            'owner_name' => 'Teh Rina Marlina',
            'category' => 'Jasa & Servis',
            'description' => 'Cuci kering setrika wangi dengan deterjen antibakteri. Gratis antar-jemput cucian khusus sesama warga RT 12 RW 05.',
            'price_range' => 'Mulai Rp 7.000 / Kg',
            'address' => 'Gg. H. Saatun No. 5B RT 012 RW 05',
            'whatsapp' => '081412357231',
            'opening_hours' => '08:00 - 20:00 WIB',
            'image' => 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?auto=format&fit=crop&w=600&q=80',
            'is_verified' => true,
            'status' => 'active'
        ]);

        Business::create([
            'name' => 'Aneka Gorengan Gurih & Es Mas Dimas',
            'owner_name' => 'Dimas Surya',
            'category' => 'Kuliner',
            'description' => 'Bakwan sayur renyah, tahu isi pedas, tempe mendoan krispi, pisang aroma cokelat, es teh manis jumbo dan es jeruk peras segar sore hari.',
            'price_range' => 'Rp 1.500 - Rp 10.000',
            'address' => 'Depan Lapangan Bulutangkis RT 12',
            'whatsapp' => '081412357231',
            'opening_hours' => '15:30 - 22:00 WIB (Sore - Malam)',
            'image' => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?auto=format&fit=crop&w=600&q=80',
            'is_verified' => true,
            'status' => 'active'
        ]);

        Business::create([
            'name' => 'Servis AC & Perbaikan Elektronik Bang Jampang',
            'owner_name' => 'Bang Supriadi (Jampang)',
            'category' => 'Jasa & Servis',
            'description' => 'Cuci AC berkala, isi freon, servis kulkas, mesin cuci, kipas angin dan instalasi listrik rumah tangga. Bergaransi dan harga khusus tetangga.',
            'price_range' => 'Cuci AC Rp 65.000 (Konsultasi Gratis)',
            'address' => 'Jl. Raya Lenteng Agung RT 12 RW 05',
            'whatsapp' => '081412357231',
            'opening_hours' => '08:00 - 17:00 WIB',
            'image' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=600&q=80',
            'is_verified' => true,
            'status' => 'active'
        ]);

        Business::create([
            'name' => 'Rumah Jahit & Vermak Busana Bu Maryam',
            'owner_name' => 'Ibu Hj. Maryam',
            'category' => 'Fashion & Busana',
            'description' => 'Menerima jahit baju gamis, kemeja batik, seragam sekolah, permak celana levis, ganti resleting dan pasang kancing cepat dan rapi.',
            'price_range' => 'Permak Mulai Rp 15.000',
            'address' => 'Gg. H. Saatun No. 20 RT 012 RW 05',
            'whatsapp' => '081412357231',
            'opening_hours' => '09:00 - 18:00 WIB',
            'image' => 'https://images.unsplash.com/photo-1558769132-cb1aea458c5e?auto=format&fit=crop&w=600&q=80',
            'is_verified' => true,
            'status' => 'active'
        ]);
    }
}
