<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $statusCounts = Complaint::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $khawatirCounts = Complaint::query()
            ->selectRaw('tingkat_khawatir, count(*) as total')
            ->groupBy('tingkat_khawatir')
            ->pluck('total', 'tingkat_khawatir');

        $jenisPelaporCounts = Complaint::query()
            ->selectRaw('jenis_pelapor, count(*) as total')
            ->groupBy('jenis_pelapor')
            ->pluck('total', 'jenis_pelapor');

        $kelurahanCounts = Complaint::query()
            ->get(['wilayah'])
            ->map(fn (Complaint $complaint) => $this->extractKelurahan($complaint->wilayah))
            ->countBy()
            ->sortDesc();

        return view('admin.dashboard', [
            'statusCounts' => $statusCounts,
            'khawatirCounts' => $khawatirCounts,
            'jenisPelaporCounts' => $jenisPelaporCounts,
            'kelurahanCounts' => $kelurahanCounts,
            'latestComplaints' => Complaint::latest()->limit(5)->get(),
        ]);
    }

    private function extractKelurahan(string $wilayah): string
    {
        if (preg_match('/Kel\\.\\s*([^,]+)/i', $wilayah, $matches)) {
            return trim($matches[1]);
        }

        return 'Tidak diketahui';
    }
}
