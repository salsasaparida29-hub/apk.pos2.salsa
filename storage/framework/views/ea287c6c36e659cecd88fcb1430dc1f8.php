

<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('success')): ?>

    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>

<?php endif; ?>

<?php if(session('error')): ?>

    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>

<?php endif; ?>

<h1>Halaman Users</h1>

<a href="<?php echo e(route('users.create')); ?>" method="GET" class="btn btn-primary mb-3">Create</a>

<form action="<?php echo e(route('users')); ?>" method="GET" class="mb-3">
<div class="input-group">
        <input
            type="text"
            name="search"
            value="<?php echo e(request('search')); ?>"
            class="form-control"
            placeholder="Search username or email"
        >

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>

    </div>

</form>

<table class="table">

    <thead>

        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

    </thead>

    <tbody>

        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>

            <td><?php echo e($users->firstItem() + $loop->index); ?></td>
            <td><?php echo e($user->name); ?></td>
            <td><?php echo e($user->email); ?></td>
            <td><?php echo e($user->role->name); ?></td>
            <td>
                <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-sm btn-warning">
                    Edit Akun
                </a>
                ||
                <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>

</table>

<?php echo e($users->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_salsa\resources\views/users/index.blade.php ENDPATH**/ ?>