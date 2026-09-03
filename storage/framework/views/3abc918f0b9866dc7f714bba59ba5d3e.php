<?php $__env->startSection('title', 'Tambah User'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <!-- Judul disesuaikan lebar maksimal dan mx-auto agar posisinya presisi di atas kotak form tengah -->
    <h4 class="fw-bold text-dark mx-auto" style="max-width: 700px; text-align: left !important; padding-left: 10px; margin-bottom: 15px;">
        Tambah User
    </h4>

    <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
        <?php echo $__env->make('users._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/users/create.blade.php ENDPATH**/ ?>