@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<h2 class="fw-bold mb-4">Dashboard Admin</h2>
@php
    $statuses = ['Belum Diproses', 'Sedang Diproses', 'Selesai', 'Ditolak'];
@endphp
<div class="row g-3">
    @foreach ($statuses as $status)
        <div class="col-md-3">
            <div class="stat-card">
                <div class="text-muted small text-uppercase">{{ $status }}</div>
                <div class="stat-value">{{ $statusCounts[$status] ?? 0 }}</div>
            </div>
        </div>
    @endforeach
    <div class="col-md-6">
        <div class="stat-card">
            <div class="text-muted small text-uppercase">Diri Sendiri</div>
            <div class="stat-value">{{ $jenisPelaporCounts['diri-sendiri'] ?? 0 }}</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="text-muted small text-uppercase">Orang Lain</div>
            <div class="stat-value">{{ $jenisPelaporCounts['orang-lain'] ?? 0 }}</div>
        </div>
    </div>
</div>

<div class="row g-3 mt-3">
    <div class="col-lg-6"><div class="panel"><h5>Tingkat Kekhawatiran</h5><canvas id="khawatirChart"></canvas></div></div>
    <div class="col-lg-6"><div class="panel"><h5>Jumlah Kekerasan per Kelurahan</h5><canvas id="wilayahChart"></canvas></div></div>
</div>

<div class="panel mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Laporan Terbaru</h5>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive p-0">
        <table class="table align-middle">
            <thead><tr><th>ID</th><th>Tanggal</th><th>Pelapor</th><th>Kategori</th><th>Status</th></tr></thead>
            <tbody>
                @forelse ($latestComplaints as $complaint)
                    <tr>
                        <td>{{ $complaint->ticket_number }}</td>
                        <td>{{ $complaint->reported_at->format('d/m/Y') }}</td>
                        <td>{{ $complaint->nama ?: 'Anonim' }}</td>
                        <td>{{ $complaint->kategori ?: '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $complaint->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada laporan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
new Chart(document.getElementById('khawatirChart'), {
    type: 'bar',
    data: { labels: @json($khawatirCounts->keys()), datasets: [{ label: 'Laporan', data: @json($khawatirCounts->values()), backgroundColor: '#28A47B' }] }
});
new Chart(document.getElementById('wilayahChart'), {
    type: 'doughnut',
    data: { labels: @json($kelurahanCounts->keys()), datasets: [{ data: @json($kelurahanCounts->values()), backgroundColor: ['#005B9F', '#28A47B', '#f59f00', '#dc3545', '#6f42c1'] }] }
});
</script>
@endpush
