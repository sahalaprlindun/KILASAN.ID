@extends('layouts.admin')

@section('title', 'Data Petugas')

@section('content')
<h2 class="fw-bold mb-4">Manajemen Petugas</h2>
<div class="panel mb-4">
    <h5>Tambah Petugas</h5>
    <form method="post" action="{{ route('admin.users.store') }}" class="row g-3">
        @csrf
        <div class="col-md-3"><input class="form-control" name="username" placeholder="Username" required></div>
        <div class="col-md-3"><input class="form-control" name="email" type="email" placeholder="Email" required></div>
        <div class="col-md-3"><input class="form-control" name="password" type="password" placeholder="Password" required></div>
        <div class="col-md-2"><select class="form-select" name="role"><option value="admin">Admin</option><option value="superadmin">Superadmin</option></select></div>
        <div class="col-md-1"><button class="btn btn-primary w-100">Tambah</button></div>
    </form>
</div>
<form method="get" class="mb-3"><input class="form-control" name="q" value="{{ request('q') }}" placeholder="Cari username / email"></form>
<div class="table-responsive">
    <table class="table align-middle">
        <thead><tr><th>Username</th><th>Email</th><th>Role</th><th>Terakhir Login</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge {{ $user->role === 'superadmin' ? 'bg-danger' : 'bg-secondary' }}">{{ $user->role }}</span></td>
                    <td>{{ $user->last_login_at?->format('d/m/Y H:i') ?: '-' }}</td>
                    <td>
                        @if (! auth()->user()->is($user))
                            <form method="post" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus petugas ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @else
                            <span class="text-muted small">Akun aktif</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
