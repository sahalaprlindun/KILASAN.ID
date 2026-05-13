<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['username' => 'superadmin'],
            ['email' => 'super@kilasan.id', 'password' => 'super123', 'role' => 'superadmin', 'name' => 'Superadmin']
        );

        User::firstOrCreate(
            ['username' => 'admin'],
            ['email' => 'admin@kilasan.id', 'password' => 'admin123', 'role' => 'admin', 'name' => 'Admin']
        );

        if (Complaint::count() === 0) {
            Complaint::create([
                'ticket_number' => 'C001',
                'reported_at' => '2026-05-10',
                'nama' => 'Ani',
                'kontak' => '08123456789',
                'wilayah' => 'Jakarta Barat, Kec. Kembangan, Kel. Meruya Utara, RT 03, RW 08',
                'jenis_kelamin' => 'Wanita',
                'usia' => 'Dewasa',
                'tingkat_khawatir' => 'Sangat Khawatir',
                'kategori' => 'KDRT',
                'jenis_pelapor' => 'diri-sendiri',
                'tempat_kejadian' => 'Rumah',
                'waktu_kejadian' => 'Malam',
                'pelaku' => 'Suami',
                'kronologi' => 'Kekerasan dalam rumah tangga berulang kali.',
            ]);
        }

        Feedback::firstOrCreate(
            ['email' => 'user@test.com'],
            ['name' => 'User', 'message' => 'Terima kasih, layanannya sangat membantu.']
        );
    }
}
