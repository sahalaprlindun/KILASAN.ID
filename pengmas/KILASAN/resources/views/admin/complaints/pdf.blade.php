<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Pengaduan - {{ $complaint->ticket_number }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; line-height: 1.4; font-size: 12px; }
        h2 { margin-bottom: 5px; }
        .header { margin-bottom: 20px; border-bottom: 1px solid #ccc; }
        .row { margin-bottom: 8px; }
        .label { font-weight: bold; width: 180px; display: inline-block; vertical-align: top; }
        .value { display: inline-block; width: calc(100% - 190px); }
        .section-title { margin-top: 15px; margin-bottom: 5px; font-weight: bold; }
        hr { margin: 15px 0; }
        .attachments { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Pengaduan Masyarakat</h2>
        <p>Nomor Pengaduan: {{ $complaint->ticket_number }}</p>
    </div>

    <div class="row">
        <span class="label">Tanggal:</span>
        <span class="value">{{ $complaint->reported_at->format('d/m/Y H:i') }}</span>
    </div>
    <div class="row">
        <span class="label">Nama Pelapor:</span>
        <span class="value">{{ $complaint->nama ?: 'Anonim' }}</span>
    </div>
    <div class="row">
        <span class="label">Kontak:</span>
        <span class="value">{{ $complaint->kontak }}</span>
    </div>
    <div class="row">
        <span class="label">Wilayah:</span>
        <span class="value">{{ $complaint->wilayah }}</span>
    </div>
    <div class="row">
        <span class="label">Jenis Kelamin:</span>
        <span class="value">{{ $complaint->jenis_kelamin }}</span>
    </div>
    <div class="row">
        <span class="label">Usia:</span>
        <span class="value">{{ $complaint->usia }}</span>
    </div>
    <div class="row">
        <span class="label">Tingkat Kekhawatiran:</span>
        <span class="value">{{ $complaint->tingkat_khawatir }}</span>
    </div>
    <div class="row">
        <span class="label">Kategori:</span>
        <span class="value">{{ $complaint->kategori ?: '-' }}</span>
    </div>
    <div class="row">
        <span class="label">Jenis Pelapor:</span>
        <span class="value">{{ $complaint->jenis_pelapor ?: '-' }}</span>
    </div>
    <div class="row">
        <span class="label">Tempat Kejadian:</span>
        <span class="value">{{ $complaint->tempat_kejadian ?: '-' }}</span>
    </div>
    <div class="row">
        <span class="label">Waktu Kejadian:</span>
        <span class="value">{{ $complaint->waktu_kejadian ?: '-' }}</span>
    </div>
    <div class="row">
        <span class="label">Pelaku:</span>
        <span class="value">{{ $complaint->pelaku ?: '-' }}</span>
    </div>
    <div class="row">
        <span class="label">Status:</span>
        <span class="value">{{ $complaint->status }}</span>
    </div>

    <hr>

    <div class="section-title">Kronologi:</div>
    <div>{{ $complaint->kronologi ?: '-' }}</div>

    <div class="section-title">Saran:</div>
    <div>{{ $complaint->saran ?: '-' }}</div>

    @if($complaint->attachments->count())
        <div class="attachments">
            <div class="section-title">Bukti Pendukung (nama file):</div>
            @foreach($complaint->attachments as $attachment)
                <div>- {{ $attachment->original_name }}</div>
            @endforeach
            <div style="font-size: 10px; margin-top: 10px;">*Isi file tidak disertakan dalam PDF ini.</div>
        </div>
    @else
        <div class="attachments">
            <div class="section-title">Bukti Pendukung:</div>
            <div>Tidak ada lampiran.</div>
        </div>
    @endif
</body>
</html>