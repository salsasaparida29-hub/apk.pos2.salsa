<?php $__env->startSection('title', 'Edit Produk'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <!-- PERBAIKAN: Teks dibuat rata kiri (text-align: left), tetapi letak areanya sejajar di atas kotak form tengah -->
    <h4 class="fw-bold text-dark mx-auto mb-3" style="max-width: 700px; text-align: left !important; padding-left: 2px;">
        Edit Produk
    </h4>

    <form action="<?php echo e(route('produk.update', $produk)); ?>"
          method="POST"
          enctype="multipart/form-data">

        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php echo $__env->make('produk._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/produk/edit.blade.php ENDPATH**/ ?>