@extends('layouts.admin')

@section('title', 'Data Pengaduan')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="fw-bold mb-0">Data Pengaduan</h2>
</div>
<form class="panel mb-3" method="get">
    <div class="row g-2">
        <div class="col-md-4"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Cari ID, nama, kontak, wilayah"></div>
        <div class="col-md-3"><select class="form-select" name="status"><option value="">Semua Status</option>@foreach(['Belum Diproses','Sedang Diproses','Selesai','Ditolak'] as $s)<option @selected(request('status') === $s)>{{ $s }}</option>@endforeach</select></div>
        <div class="col-md-3"><select class="form-select" name="tingkat_khawatir"><option value="">Semua Kekhawatiran</option>@foreach(['Sedikit Khawatir','Khawatir','Sangat Khawatir'] as $s)<option @selected(request('tingkat_khawatir') === $s)>{{ $s }}</option>@endforeach</select></div>
        <div class="col-md-2"><button class="btn btn-primary w-100">Filter</button></div>
    </div>
</form>
<div class="table-responsive">
    <table class="table align-middle">
        <thead><tr><th>ID</th><th>Tgl</th><th>Pelapor</th><th>Kontak</th><th>Kekhawatiran</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse ($complaints as $complaint)
                <tr>
                    <td>{{ $complaint->ticket_number }}</td>
                    <td>{{ $complaint->reported_at->format('d/m/Y') }}</td>
                    <td>{{ $complaint->nama ?: 'Anonim' }}</td>
                    <td>{{ $complaint->kontak }}</td>
                    <td>{{ $complaint->tingkat_khawatir }}</td>
                    <td>{{ $complaint->kategori ?: '-' }}</td>
                    <td>
                        <form method="post" action="{{ route('admin.complaints.status', $complaint) }}">
                            @csrf @method('PATCH')
                            <select class="form-select form-select-sm" name="status" onchange="this.form.submit()">
                                @foreach(['Belum Diproses','Sedang Diproses','Selesai','Ditolak'] as $s)<option @selected($complaint->status === $s)>{{ $s }}</option>@endforeach
                            </select>
                        </form>
                    </td>
                    <td><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.complaints.show', $complaint) }}">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted">Data belum ada.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $complaints->links() }}
</div>
@endsection
