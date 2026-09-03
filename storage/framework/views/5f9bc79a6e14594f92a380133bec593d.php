<?php $__env->startSection('title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <!-- Menambahkan class text-center dan membatasi lebar maksimal agar sejajar dengan form -->
    <h4 class="fw-bold text-dark text-center mx-auto" style="max-width: 700px; text-align: left !important; padding-left: 10px;">
        Tambah Produk
    </h4>

    <form action="<?php echo e(route('produk.store')); ?>"
          method="POST"
          enctype="multipart/form-data">
        <?php echo $__env->make('Produk._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/produk/create.blade.php ENDPATH**/ ?>