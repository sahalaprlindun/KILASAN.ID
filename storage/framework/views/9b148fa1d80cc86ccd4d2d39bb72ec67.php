<?php $__env->startSection('title', 'Detail Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Detail <?php echo e($complaint->ticket_number); ?></h2>
    <div>
        <a href="<?php echo e(route('admin.complaints.index')); ?>" class="btn btn-outline-secondary me-2">Kembali</a>
        <a href="<?php echo e(route('admin.complaints.pdf', $complaint)); ?>" class="btn btn-primary" target="_blank">Export PDF</a>
    </div>
</div>
<div class="panel">
    <div class="row g-3">
        <?php $__currentLoopData = [
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
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6"><strong><?php echo e($label); ?>:</strong> <?php echo e($value); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12"><strong>Kronologi:</strong><p><?php echo e($complaint->kronologi ?: '-'); ?></p></div>
        <div class="col-12"><strong>Saran:</strong><p><?php echo e($complaint->saran ?: '-'); ?></p></div>
    </div>

    <h5 class="mt-4">Bukti Pendukung</h5>
    <?php $__empty_1 = true; $__currentLoopData = $complaint->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <a class="btn btn-sm btn-outline-primary me-2 mb-2" href="<?php echo e(asset('storage/' . $attachment->path)); ?>" target="_blank"><?php echo e($attachment->original_name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">Tidak ada lampiran.</p>
    <?php endif; ?>

    <form method="post" action="<?php echo e(route('admin.complaints.destroy', $complaint)); ?>" onsubmit="return confirm('Yakin hapus laporan ini?')" class="mt-4">
        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
        <button class="btn btn-danger">Hapus Pengaduan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pengmas\KILASAN\resources\views/admin/complaints/show.blade.php ENDPATH**/ ?>