

<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>
<h4>Edit User</h4>

<form action="<?php echo e(route('admin.users.update', $user)); ?>" method="post">
<?php echo $__env->make('users._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_salsa\resources\views/users/edit.blade.php ENDPATH**/ ?>