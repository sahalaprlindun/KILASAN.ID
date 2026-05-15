<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<h2 class="fw-bold mb-4">Dashboard Admin</h2>
<?php
    $statuses = ['Belum Diproses', 'Sedang Diproses', 'Selesai', 'Ditolak'];
?>
<div class="row g-3">
    <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="text-muted small text-uppercase"><?php echo e($status); ?></div>
                <div class="stat-value"><?php echo e($statusCounts[$status] ?? 0); ?></div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="text-muted small text-uppercase">Diri Sendiri</div>
            <div class="stat-value"><?php echo e($jenisPelaporCounts['diri-sendiri'] ?? 0); ?></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="text-muted small text-uppercase">Orang Lain</div>
            <div class="stat-value"><?php echo e($jenisPelaporCounts['orang-lain'] ?? 0); ?></div>
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
        <a href="<?php echo e(route('admin.complaints.index')); ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive p-0">
        <table class="table align-middle">
            <thead><tr><th>ID</th><th>Tanggal</th><th>Pelapor</th><th>Kategori</th><th>Status</th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $latestComplaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($complaint->ticket_number); ?></td>
                        <td><?php echo e($complaint->reported_at->format('d/m/Y')); ?></td>
                        <td><?php echo e($complaint->nama ?: 'Anonim'); ?></td>
                        <td><?php echo e($complaint->kategori ?: '-'); ?></td>
                        <td><span class="badge bg-secondary"><?php echo e($complaint->status); ?></span></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center text-muted">Belum ada laporan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
new Chart(document.getElementById('khawatirChart'), {
    type: 'bar',
    data: { labels: <?php echo json_encode($khawatirCounts->keys(), 15, 512) ?>, datasets: [{ label: 'Laporan', data: <?php echo json_encode($khawatirCounts->values(), 15, 512) ?>, backgroundColor: '#28A47B' }] }
});
new Chart(document.getElementById('wilayahChart'), {
    type: 'doughnut',
    data: { labels: <?php echo json_encode($kelurahanCounts->keys(), 15, 512) ?>, datasets: [{ data: <?php echo json_encode($kelurahanCounts->values(), 15, 512) ?>, backgroundColor: ['#005B9F', '#28A47B', '#f59f00', '#dc3545', '#6f42c1'] }] }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pengmas\KILASAN\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>