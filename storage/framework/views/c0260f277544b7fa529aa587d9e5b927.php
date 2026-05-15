<?php $__env->startSection('title', 'Saran dari Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
<h2 class="fw-bold mb-4">Saran & Masukan Pengaduan</h2>
<div class="table-responsive">
    <table class="table align-middle">
        <thead><tr><th>Nama Pelapor</th><th>Kontak</th><th>Saran/Masukan</th><th>Tanggal</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaints): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($complaints->nama ?: '(Anonim)'); ?></td>
                    <td><?php echo e($complaints->kontak ?: '-'); ?></td>
                    <td><?php echo e($complaints->saran ?: '-'); ?></td>
                    <td><?php echo e($complaints->reported_at?->format('d/m/Y') ?: '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4" class="text-center text-muted">Belum ada saran dari pengaduan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($feedbacks->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pengmas\KILASAN\resources\views/admin/feedback/index.blade.php ENDPATH**/ ?>