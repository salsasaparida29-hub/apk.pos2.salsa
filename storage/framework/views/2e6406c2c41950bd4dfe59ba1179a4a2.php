<?php $__env->startSection('title', 'penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('errors')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('errors')); ?>

    </div>
<?php endif; ?>

<h1>Halaman penjualan</h1>

<a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-primary mb-3">Create</a>

<form action="<?php echo e(route('penjualan.index')); ?>" method="GET" class="mb-3">
    <div class="input-group">

        <input
            type="text"
            name="search"
            value="<?php echo e(request()->search); ?>"
            class="form-control"
            placeholder="Search penjualan">

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>

    </div>
</form>

<table class="table">

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Kasir</th>
            <th scope="col">Total Pembayaran</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <tbody>

        <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <tr>
            <th scope="row" class="align-middle"><?php echo e(($sales->firstItem() + $loop->index)); ?></th>
            <td class="align-middle"><?php echo e($sale->created_at->translatedFormat('d-m-Y- H:i:s')); ?></td>
            <td class="align-middle"><?php echo e($sale->user->name); ?></td>
            <td class="align-middle">Rp. <?php echo e(number_format ($sale->total_pembayaran)); ?></td>
            <td class="align-middle"><?php echo e($sale->metode_pembayaran); ?></td>
            <td class="align-middle"><?php echo e($sale->status); ?></td>
            
            <td class="align-middle">
                <div class="d-flex gap-1 align-items-center">
                    <!-- Tombol Detail -->
                    <a href="<?php echo e(route('penjualan.show', $sale)); ?>" class="btn btn-primary btn-sm">
                        Detail
                    </a>
                    
                    <span>||</span>
                    
                    <!-- Tombol Edit (Proteksi dicabut agar pasti muncul untuk Kasir) -->
                    <a href="<?php echo e(route('penjualan.edit', $sale)); ?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    
                    <span>||</span>
                    
                    <!-- Tombol Hapus (Proteksi dicabut agar pasti muncul untuk Kasir) -->
                    <form action="<?php echo e(route('penjualan.destroy', $sale)); ?>" method="POST" class="d-inline mb-0">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <tr>
            <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
        </tr>

        <?php endif; ?>

    </tbody>

</table>

<?php echo e($sales->links()); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rpspp\apk.pos.salsa\resources\views/penjualan/index.blade.php ENDPATH**/ ?>