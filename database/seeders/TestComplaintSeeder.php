<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\ComplaintAttachment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestComplaintSeeder extends Seeder
{
    /**
     * Run the seeder untuk testing.
     */
    public function run(): void
    {
        // Buat complaint tambahan untuk testing (C002)
        $complaint = Complaint::firstOrCreate(
            ['ticket_number' => 'C002'],
            [
                'reported_at' => now()->toDateString(),
                'nama' => 'Budi Santoso',
                'kontak' => '08987654321',
                'wilayah' => 'Jakarta Pusat, Kec. Senen, Kel. Cemp Putih',
                'jenis_kelamin' => 'Laki-laki',
                'usia' => 'Dewasa',
                'tingkat_khawatir' => 'Khawatir',
                'kategori' => 'KDRT',
                'jenis_pelapor' => 'keluarga',
                'tempat_kejadian' => 'Rumah',
                'waktu_kejadian' => 'Siang',
                'pelaku' => 'Istri',
                'kronologi' => 'Terjadi konflik rumah tangga yang mengakibatkan kekerasan verbal.',
                'saran' => 'Mohon bantuan mediasi keluarga',
                'status' => 'Sedang Diproses',
            ]
        );

        // Test complaint dengan status berbeda
        Complaint::firstOrCreate(
            ['ticket_number' => 'C003'],
            [
                'reported_at' => now()->subDays(5)->toDateString(),
                'nama' => 'Siti Nurhaliza',
                'kontak' => '08555666777',
                'wilayah' => 'Bandung',
                'jenis_kelamin' => 'Wanita',
                'usia' => 'Dewasa',
                'tingkat_khawatir' => 'Sangat Khawatir',
                'kategori' => 'KDRT',
                'jenis_pelapor' => 'diri-sendiri',
                'tempat_kejadian' => 'Tempat Kerja',
                'waktu_kejadian' => 'Pagi',
                'pelaku' => 'Rekan Kerja',
                'kronologi' => 'Pelecehan di tempat kerja',
                'saran' => 'Lapor ke HRD',
                'status' => 'Selesai',
                'handled_by' => 2,
            ]
        );

        // Test complaint dengan status ditolak
        Complaint::firstOrCreate(
            ['ticket_number' => 'C004'],
            [
                'reported_at' => now()->subDays(10)->toDateString(),
                'nama' => 'Eka Suryanto',
                'kontak' => '08111222333',
                'wilayah' => 'Surabaya',
                'jenis_kelamin' => 'Laki-laki',
                'usia' => 'Remaja',
                'tingkat_khawatir' => 'Cukup Khawatir',
                'kategori' => 'Intimidasi',
                'jenis_pelapor' => 'lainnya',
                'tempat_kejadian' => 'Jalan',
                'waktu_kejadian' => 'Malam',
                'pelaku' => 'Preman',
                'kronologi' => 'Intimidasi oleh kelompok preman',
                'saran' => 'Lapor polisi',
                'status' => 'Ditolak',
                'handled_by' => 1,
            ]
        );
    }
}
