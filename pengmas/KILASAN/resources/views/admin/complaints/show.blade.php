@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Detail {{ $complaint->ticket_number }}</h2>
    <div>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-outline-secondary me-2">Kembali</a>
        <a href="{{ route('admin.complaints.pdf', $complaint) }}" class="btn btn-primary" target="_blank">Export PDF</a>
    </div>
</div>
<div class="panel">
    <div class="row g-3">
        @foreach ([
            'Tanggal' => $complaint->reported_at->format('d/m/Y'),
            'Nama Pelapor' => $complaint->nama ?: 'Anonim',
            'Kontak' => $complaint->kontak,
            'Wilayah' => $complaint->wilayah,
            'Jenis Kelamin' => $complaint->jenis_kelamin,
            'Usia' => $complaint->usia,
            'Tingkat Kekhawatiran' => $complaint->tingkat_khawatir,
            'Kategori' => $complaint->kategori ?: '-',
            'Jenis Pelapor' => $complaint->jenis_pelapor ?: '-',
            'Tempat Kejadian' => $complaint->tempat_kejadian ?: '-',
            'Waktu Kejadian' => $complaint->waktu_kejadian ?: '-',
            'Pelaku' => $complaint->pelaku ?: '-',
            'Status' => $complaint->status,
        ] as $label => $value)
            <div class="col-md-6"><strong>{{ $label }}:</strong> {{ $value }}</div>
        @endforeach
        <div class="col-12"><strong>Kronologi:</strong><p>{{ $complaint->kronologi ?: '-' }}</p></div>
        <div class="col-12"><strong>Saran:</strong><p>{{ $complaint->saran ?: '-' }}</p></div>
    </div>

    <h5 class="mt-4">Bukti Pendukung</h5>
    @forelse ($complaint->attachments as $attachment)
    <a class="btn btn-sm btn-outline-primary me-2 mb-2" href="{{ asset('storage/' . $attachment->path) }}" target="_blank">{{ $attachment->original_name }}</a>
    @empty
        <p class="text-muted">Tidak ada lampiran.</p>
    @endforelse

    <form method="post" action="{{ route('admin.complaints.destroy', $complaint) }}" onsubmit="return confirm('Yakin hapus laporan ini?')" class="mt-4">
        @csrf @method('DELETE')
        <button class="btn btn-danger">Hapus Pengaduan</button>
    </form>
</div>
@endsection
