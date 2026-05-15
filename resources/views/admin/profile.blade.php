@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<h2 class="fw-bold mb-4">Profil Admin</h2>
<div class="panel">
    <form method="post" action="{{ route('admin.profile.update') }}" class="row g-3">
        @csrf @method('PATCH')
        <div class="col-md-6">
            <label class="form-label">Username</label>
            <input class="form-control" name="username" value="{{ old('username', $user->username) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" type="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Password Baru</label>
            <input class="form-control" name="password" type="password" placeholder="Kosongkan jika tidak diubah">
        </div>
        <div class="col-12"><button class="btn btn-primary">Simpan Profil</button></div>
    </form>
</div>
@endsection
