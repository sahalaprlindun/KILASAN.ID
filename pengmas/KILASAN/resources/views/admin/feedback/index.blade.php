@extends('layouts.admin')

@section('title', 'Saran dari Pengaduan')

@section('content')
<h2 class="fw-bold mb-4">Saran & Masukan Pengaduan</h2>
<div class="table-responsive">
    <table class="table align-middle">
        <thead><tr><th>Nama Pelapor</th><th>Kontak</th><th>Saran/Masukan</th><th>Tanggal</th></tr></thead>
        <tbody>
            @forelse ($feedbacks as $complaints)
                <tr>
                    <td>{{ $complaints->nama ?: '(Anonim)' }}</td>
                    <td>{{ $complaints->kontak ?: '-' }}</td>
                    <td>{{ $complaints->saran ?: '-' }}</td>
                    <td>{{ $complaints->reported_at?->format('d/m/Y') ?: '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada saran dari pengaduan.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $feedbacks->links() }}
</div>
@endsection
