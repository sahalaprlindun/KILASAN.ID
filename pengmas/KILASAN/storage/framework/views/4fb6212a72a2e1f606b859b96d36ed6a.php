<?php $__env->startSection('title', 'Data Petugas'); ?>

<?php $__env->startSection('content'); ?>
<h2 class="fw-bold mb-4">Manajemen Petugas</h2>
<div class="panel mb-4">
    <h5>Tambah Petugas</h5>
    <form method="post" action="<?php echo e(route('admin.users.store')); ?>" class="row g-3">
        <?php echo csrf_field(); ?>
        <div class="col-md-3"><input class="form-control" name="username" placeholder="Username" required></div>
        <div class="col-md-3"><input class="form-control" name="email" type="email" placeholder="Email" required></div>
        <div class="col-md-3"><input class="form-control" name="password" type="password" placeholder="Password" required></div>
        <div class="col-md-2"><select class="form-select" name="role"><option value="admin">Admin</option><option value="superadmin">Superadmin</option></select></div>
        <div class="col-md-1"><button class="btn btn-primary w-100">Tambah</button></div>
    </form>
</div>
<form method="get" class="mb-3"><input class="form-control" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari username / email"></form>
<div class="table-responsive">
    <table class="table align-middle">
        <thead><tr><th>Username</th><th>Email</th><th>Role</th><th>Terakhir Login</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->username); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><span class="badge <?php echo e($user->role === 'superadmin' ? 'bg-danger' : 'bg-secondary'); ?>"><?php echo e($user->role); ?></span></td>
                    <td><?php echo e($user->last_login_at?->format('d/m/Y H:i') ?: '-'); ?></td>
                    <td>
                        <?php if(! auth()->user()->is($user)): ?>
                            <form method="post" action="<?php echo e(route('admin.users.destroy', $user)); ?>" onsubmit="return confirm('Hapus petugas ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        <?php else: ?>
                            <span class="text-muted small">Akun aktif</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($users->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pengmas\KILASAN\resources\views/admin/users/index.blade.php ENDPATH**/ ?>