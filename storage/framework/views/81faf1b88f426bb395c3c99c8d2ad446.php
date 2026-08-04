<?php $__env->startSection('title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<h4>Tambah Produk</h4>

<form action="<?php echo e(route('produk.store')); ?>"
        method="POST"
        enctype="multipart/form-data">
<?php echo $__env->make('Produk._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rpspp\apk.pos.salsa\resources\views/produk/create.blade.php ENDPATH**/ ?>