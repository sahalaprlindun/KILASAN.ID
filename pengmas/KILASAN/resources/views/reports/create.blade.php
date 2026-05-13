@extends('layouts.app')

@section('title', 'Form Pengaduan')

@section('content')
<section class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Form Pengaduan</h1>
        <p class="text-muted">Isi data laporan. Data yang dikirim akan tersimpan ke database dan muncul di dashboard admin.</p>
    </div>

    <div class="card p-4">
        <form method="post" action="{{ route('reports.store') }}" enctype="multipart/form-data" id="report-form">
            @csrf
            <input type="hidden" name="wilayah" id="wilayah_combined" value="{{ old('wilayah') }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jenis Pelapor</label>
                    <select class="form-select" name="jenis_pelapor">
                        <option value="diri-sendiri">Diri Sendiri</option>
                        <option value="orang-lain">Orang Lain</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Pelapor</label>
                    <input class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Boleh anonim">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Kontak WA/Telepon *</label>
                    <input class="form-control" name="kontak" value="{{ old('kontak') }}" required placeholder="08xxxxxxxxxx">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jenis Kelamin *</label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option>Pria</option>
                        <option>Wanita</option>
                    </select>
                </div>
            </div>

            <div class="panel mt-4">
                <h5 class="fw-bold">Data Lokasi</h5>
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label">Kota/Kabupaten</label><select id="kota" class="form-select" required></select></div>
                    <div class="col-md-4"><label class="form-label">Kecamatan</label><select id="kecamatan" class="form-select" required></select></div>
                    <div class="col-md-4"><label class="form-label">Kelurahan</label><select id="kelurahan" class="form-select" required></select></div>
                    <div class="col-md-2"><label class="form-label">RT</label><select id="rt" class="form-select" required></select></div>
                    <div class="col-md-2"><label class="form-label">RW</label><select id="rw" class="form-select" required></select></div>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Usia *</label>
                    <select class="form-select" name="usia" required>
                        <option value="">-- Pilih --</option><option>Balita</option><option>Remaja</option><option>Dewasa</option><option>Lansia</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Tingkat Kekhawatiran *</label>
                    <select class="form-select" name="tingkat_khawatir" required>
                        <option value="">-- Pilih --</option><option>Sedikit Khawatir</option><option>Khawatir</option><option>Sangat Khawatir</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Kategori</label>
                    <select class="form-select" name="kategori">
                        <option value="">-- Pilih --</option><option>KDRT</option><option>Kekerasan Seksual</option><option>Kekerasan Fisik</option><option>Kekerasan Psikis</option><option>Penelantaran</option><option>Lainnya</option>
                    </select>
                </div>
                <div class="col-md-4"><label class="form-label fw-bold">Tempat Kejadian</label><input class="form-control" name="tempat_kejadian" placeholder="Rumah, sekolah, tempat kerja"></div>
                <div class="col-md-4"><label class="form-label fw-bold">Waktu Kejadian</label><select class="form-select" name="waktu_kejadian"><option>Pagi</option><option>Siang</option><option>Sore</option><option>Malam</option></select></div>
                <div class="col-md-4"><label class="form-label fw-bold">Pelaku</label><input class="form-control" name="pelaku" placeholder="Contoh: orang tidak dikenal"></div>
                <div class="col-12"><label class="form-label fw-bold">Kronologi Singkat</label><textarea class="form-control" name="kronologi" rows="4">{{ old('kronologi') }}</textarea></div>
                <div class="col-12"><label class="form-label fw-bold">Saran / Masukan</label><textarea class="form-control" name="saran" rows="2">{{ old('saran') }}</textarea></div>
                <div class="col-12"><label class="form-label fw-bold">Bukti Pendukung</label><input class="form-control" type="file" name="bukti[]" multiple></div>
            </div>

            <button class="btn btn-primary w-100 mt-4 py-2 fw-bold">Kirim Laporan</button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
const dataWilayah = {
    "Jakarta Barat": {
        "Kembangan": ["Meruya Utara", "Meruya Selatan", "Kembangan Utara", "Kembangan Selatan", "Srengseng"],
        "Cengkareng": ["Cengkareng Barat", "Cengkareng Timur", "Duri Kosambi", "Kapuk", "Rawa Buaya"],
        "Kalideres": ["Kalideres", "Kamal", "Pegadungan", "Semanan", "Tegal Alur"]
    },
    "Jakarta Selatan": {
        "Kebayoran Baru": ["Cipete", "Gandaria", "Gunung", "Melawai", "Senayan"],
        "Pasar Minggu": ["Jati Padang", "Kebagusan", "Pasar Minggu", "Pejaten Barat", "Ragunan"]
    }
};
const kota = document.getElementById('kota'), kecamatan = document.getElementById('kecamatan'), kelurahan = document.getElementById('kelurahan'), rt = document.getElementById('rt'), rw = document.getElementById('rw'), wilayah = document.getElementById('wilayah_combined');
function fill(select, items, prefix = '') { select.innerHTML = items.map(i => `<option value="${prefix}${i}">${prefix}${i}</option>`).join(''); }
function updateWilayah() { wilayah.value = [kota.value, 'Kec. ' + kecamatan.value, 'Kel. ' + kelurahan.value, rt.value, rw.value].join(', '); }
function updateKecamatan() { fill(kecamatan, Object.keys(dataWilayah[kota.value])); updateKelurahan(); }
function updateKelurahan() { fill(kelurahan, dataWilayah[kota.value][kecamatan.value]); updateWilayah(); }
fill(kota, Object.keys(dataWilayah)); fill(rt, Array.from({length: 20}, (_, i) => String(i + 1).padStart(2, '0')), 'RT '); fill(rw, Array.from({length: 20}, (_, i) => String(i + 1).padStart(2, '0')), 'RW ');
kota.value = 'Jakarta Barat'; updateKecamatan();
[kota, kecamatan, kelurahan, rt, rw].forEach(el => el.addEventListener('change', () => { if (el === kota) updateKecamatan(); else if (el === kecamatan) updateKelurahan(); else updateWilayah(); }));
</script>
@endpush
