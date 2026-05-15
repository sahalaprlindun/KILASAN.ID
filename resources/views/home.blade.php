@extends('layouts.app')

@section('title', 'KILASAN')

@section('content')
<section class="container py-5">
    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <h1 class="fw-bold display-5">KILASAN</h1>
            <p class="lead text-muted">Kita Lapor Kekerasan. Laporkan kejadian secara aman dan data akan langsung masuk ke dashboard admin.</p>
            <a class="btn btn-primary px-4 py-2" href="{{ route('reports.create') }}">Buat Laporan</a>
        </div>
        <div class="col-lg-6">
            <img class="img-fluid rounded-4" src="{{ asset('asset/ilustrasikekerasan.png') }}" alt="Ilustrasi KILASAN">
        </div>
    </div>
</section>
@endsection
