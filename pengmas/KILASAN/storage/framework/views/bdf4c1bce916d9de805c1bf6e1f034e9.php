<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'KILASAN'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: Rubik, sans-serif; background: #f6f8fb; color: #1f2a3e; }
        .main-header { background: #fff; box-shadow: 0 5px 20px rgba(0,0,0,.05); }
        .navbar-brand img { max-height: 72px; }
        .btn-primary, .btn-primary:focus { background: #28A47B; border-color: #28A47B; border-radius: 40px; }
        .btn-primary:hover { background: #1F8A67; border-color: #1F8A67; }
        .card, .panel { border: 0; border-radius: 16px; box-shadow: 0 12px 28px rgba(0,0,0,.06); }
        .footer { background: linear-gradient(115deg, #005B9F 0%, #28A47B 100%); color: white; padding: 32px 0; margin-top: 48px; }
        .footer a { color: white; }
        .form-control, .form-select { border-radius: 10px; padding: .75rem; }
    </style>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body>
<header class="main-header">
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('asset/newlogo.png')); ?>" alt="Logo KILASAN">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('reports.create')); ?>">Lapor Online</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <?php if(session('success')): ?>
        <div class="container mt-4"><div class="alert alert-success"><?php echo e(session('success')); ?></div></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="container mt-4">
            <div class="alert alert-danger">
                <strong>Periksa kembali data Anda.</strong>
                <ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
            </div>
        </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>

<footer class="footer">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-md-8">
                <strong>KILASAN</strong>
                <p class="mb-0 mt-2">Platform pengaduan dan layanan informasi untuk membantu masyarakat melaporkan kekerasan secara aman, cepat, dan terpercaya.</p>
            </div>
            <div class="col-md-4">
                <p class="mb-0"><i class="fab fa-whatsapp me-2"></i>0811-129-129<br><i class="fas fa-globe me-2"></i><a href="<?php echo e(route('reports.create')); ?>">Lapor Online</a></p>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\pengmas\KILASAN\resources\views/layouts/app.blade.php ENDPATH**/ ?>