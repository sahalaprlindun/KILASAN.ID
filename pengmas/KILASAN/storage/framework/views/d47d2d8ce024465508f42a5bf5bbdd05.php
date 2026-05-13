<?php $__env->startSection('title', 'Data Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="fw-bold mb-0">Data Pengaduan</h2>
</div>
<form class="panel mb-3" method="get">
    <div class="row g-2">
        <div class="col-md-4"><input class="form-control" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari ID, nama, kontak, wilayah"></div>
        <div class="col-md-3"><select class="form-select" name="status"><option value="">Semua Status</option><?php $__currentLoopData = ['Belum Diproses','Sedang Diproses','Selesai','Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option <?php if(request('status') === $s): echo 'selected'; endif; ?>><?php echo e($s); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
        <div class="col-md-3"><select class="form-select" name="tingkat_khawatir"><option value="">Semua Kekhawatiran</option><?php $__currentLoopData = ['Sedikit Khawatir','Khawatir','Sangat Khawatir']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option <?php if(request('tingkat_khawatir') === $s): echo 'selected'; endif; ?>><?php echo e($s); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
        <div class="col-md-2"><button class="btn btn-primary w-100">Filter</button></div>
    </div>
</form>
<div class="table-responsive">
    <table class="table align-middle">
        <thead><tr><th>ID</th><th>Tgl</th><th>Pelapor</th><th>Kontak</th><th>Kekhawatiran</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($complaint->ticket_number); ?></td>
                    <td><?php echo e($complaint->reported_at->format('d/m/Y')); ?></td>
                    <td><?php echo e($complaint->nama ?: 'Anonim'); ?></td>
                    <td><?php echo e($complaint->kontak); ?></td>
                    <td><?php echo e($complaint->tingkat_khawatir); ?></td>
                    <td><?php echo e($complaint->kategori ?: '-'); ?></td>
                    <td>
                        <form method="post" action="<?php echo e(route('admin.complaints.status', $complaint)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <select class="form-select form-select-sm" name="status" onchange="this.form.submit()">
                                <?php $__currentLoopData = ['Belum Diproses','Sedang Diproses','Selesai','Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option <?php if($complaint->status === $s): echo 'selected'; endif; ?>><?php echo e($s); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </form>
                    </td>
                    <td><a class="btn btn-sm btn-outline-primary" href="<?php echo e(route('admin.complaints.show', $complaint)); ?>">Detail</a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center text-muted">Data belum ada.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php echo e($complaints->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pengmas\KILASAN\resources\views/admin/complaints/index.blade.php ENDPATH**/ ?>