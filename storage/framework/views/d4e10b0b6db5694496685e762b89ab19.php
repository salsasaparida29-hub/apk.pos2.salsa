<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
    html, body {
        height: 100%;
        margin: 0;
    }
    body {
        background: #eceff3;
        font-family: -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
        display: flex;
        flex-direction: column;
    }
    /* Notifikasi full-width di atas halaman, seperti pada screenshot */
    .status-banner {
        width: 100%;
        padding: 16px 24px;
        margin: 0;
        border-radius: 0;
        border: none;
        border-bottom: 1px solid #badbcc;
    }
    .login-wrapper {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }
    .login-card {
        width: 100%;
        max-width: 400px;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.08) !important;
    }
    .login-card .card-header {
        background: #0b5ed8;
        color: #ffffff;
        font-weight: 700;
        font-size: 18px;
        text-align: center;
        border-bottom: 1px solid #dee2e6;
        padding: 18px;
    }
    .form-label {
        color: #212529;
        font-weight: 600;
    }
    .form-control {
        border-color: #e2e6ee;
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .btn-indigo {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff;
    }
    .btn-indigo:hover {
        background-color: #0b5ed8;
        border-color: #0a58ca;
        color: #ffffff;
    }
    .alert-success-custom {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }
    .alert-danger-custom {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }
</style>

</head>

<body>

<?php if(session('status')): ?>
    <!-- Notifikasi full-width, tampil di paling atas halaman -->
    <div class="alert alert-success-custom status-banner small mb-0">
        <?php echo e(session('status')); ?>

    </div>
<?php endif; ?>

<div class="login-wrapper">
<div class="container d-flex justify-content-center">

    <div class="login-card card bg-white">

        <div class="card-header">Login Pos</div>
        <div class="card-body p-4">

            <?php if($errors->any()): ?>
                <!-- Menggunakan class alert kustom yang baru -->
                <div class="alert alert-danger-custom py-2 mb-3 small rounded-3">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('auth')); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" placeholder="" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="" required>
                </div>
                <!-- Mengubah class tombol dari btn-primary menjadi btn-indigo -->
                <button type="submit" class="btn btn-indigo w-100 rounded-2 py-2 fw-semibold">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html><?php /**PATH C:\Users\rpspp\apk.pos.salsa\resources\views/login.blade.php ENDPATH**/ ?>