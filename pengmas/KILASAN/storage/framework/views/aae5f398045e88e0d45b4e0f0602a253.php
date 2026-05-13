<?php $__env->startSection('title', 'Profil Admin'); ?>

<?php $__env->startSection('content'); ?>
<h2 class="fw-bold mb-4">Profil Admin</h2>
<div class="panel">
    <form method="post" action="<?php echo e(route('admin.profile.update')); ?>" class="row g-3">
        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
        <div class="col-md-6">
            <label class="form-label">Username</label>
            <input class="form-control" name="username" value="<?php echo e(old('username', $user->username)); ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" type="email" value="<?php echo e(old('email', $user->email)); ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Password Baru</label>
            <input class="form-control" name="password" type="password" placeholder="Kosongkan jika tidak diubah">
        </div>
        <div class="col-12"><button class="btn btn-primary">Simpan Profil</button></div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pengmas\KILASAN\resources\views/admin/profile.blade.php ENDPATH**/ ?>