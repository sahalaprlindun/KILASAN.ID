<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class ComplaintController extends Controller
{
    public function index(Request $request): View
    {
        $complaints = Complaint::with('attachments')
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->string('q');
                $query->where(function ($subQuery) use ($q) {
                    $subQuery->where('nama', 'like', "%{$q}%")
                        ->orWhere('kontak', 'like', "%{$q}%")
                        ->orWhere('wilayah', 'like', "%{$q}%")
                        ->orWhere('ticket_number', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('tingkat_khawatir'), fn ($query) => $query->where('tingkat_khawatir', $request->tingkat_khawatir))
            ->when($request->filled('kategori'), fn ($query) => $query->where('kategori', $request->kategori))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint): View
    {
        $complaint->load('attachments', 'handler');

        return view('admin.complaints.show', compact('complaint'));
    }

    public function updateStatus(Request $request, Complaint $complaint): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Belum Diproses,Sedang Diproses,Selesai,Ditolak'],
        ]);

        $complaint->update([
            'status' => $validated['status'],
            'handled_by' => $request->user()->id,
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint): RedirectResponse
    {
        foreach ($complaint->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->path);
        }

        $complaint->delete();

        return redirect()->route('admin.complaints.index')->with('success', 'Laporan berhasil dihapus.');
    }

    public function exportPDF(Complaint $complaint)
    {
    $complaint->load('attachments');
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.complaints.pdf', compact('complaint'));
    return $pdf->download('pengaduan_' . $complaint->ticket_number . '.pdf');
}
}
