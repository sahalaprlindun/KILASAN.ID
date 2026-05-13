<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function create(): View
    {
        return view('reports.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['nullable', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:50'],
            'wilayah' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string', 'max:30'],
            'usia' => ['required', 'string', 'max:30'],
            'tingkat_khawatir' => ['required', 'string', 'max:50'],
            'kategori' => ['nullable', 'string', 'max:80'],
            'jenis_pelapor' => ['nullable', 'string', 'max:50'],
            'tempat_kejadian' => ['nullable', 'string', 'max:255'],
            'waktu_kejadian' => ['nullable', 'string', 'max:80'],
            'pelaku' => ['nullable', 'string', 'max:255'],
            'kronologi' => ['nullable', 'string'],
            'saran' => ['nullable', 'string'],
            'bukti.*' => ['nullable', 'file', 'max:10240', 'mimes:jpg,jpeg,png,pdf,mp4,mov,webm'],
        ]);

        $complaint = DB::transaction(function () use ($request, $validated) {
            $complaintData = collect($validated)->except('bukti')->all();

            $complaint = Complaint::create([
                ...$complaintData,
                'ticket_number' => $this->nextTicketNumber(),
                'reported_at' => now()->toDateString(),
                'nama' => ($validated['nama'] ?? '') ?: null,
                'status' => 'Belum Diproses',
            ]);

            foreach ($request->file('bukti', []) as $file) {
                $path = $file->store('complaint-attachments/'.$complaint->ticket_number, 'public');
                $complaint->attachments()->create([
                    'original_name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                    'size' => $file->getSize(),
                ]);
            }

            return $complaint;
        });

        return back()->with('success', 'Laporan berhasil dikirim. ID laporan: '.$complaint->ticket_number);
    }

    private function nextTicketNumber(): string
    {
        $last = Complaint::query()
            ->where('ticket_number', 'like', 'C%')
            ->latest('id')
            ->value('ticket_number');

        $number = $last ? ((int) Str::after($last, 'C')) + 1 : 1;

        return 'C'.str_pad((string) $number, 3, '0', STR_PAD_LEFT);
    }
}
