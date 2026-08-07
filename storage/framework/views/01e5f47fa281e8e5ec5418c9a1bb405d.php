

<?php $__env->startSection('title', 'Detail Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- Class text-center ditambahkan agar tulisan bergeser ke tengah -->
<h1 class="text-center mb-4">Halaman Detail Penjualan</h1>

<a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-secondary mb-3">
    Kembali ke Daftar
</a>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row" width="250">ID Transaksi</th>
            <td><?php echo e($penjualan->id); ?></td>
        </tr>
        <tr>
            <th scope="row">Metode Pembayaran</th>
            <td><?php echo e($penjualan->metode_pembayaran); ?></td>
        </tr>
        <tr>
            <th scope="row">Status</th>
            <td><?php echo e($penjualan->status); ?></td>
        </tr>
        <tr>
            <th scope="row">Total Pembayaran</th>
            <td>Rp. <?php echo e(number_format($penjualan->total_pembayaran)); ?></td>
        </tr>
        <tr>
            <th scope="row">Waktu Transaksi</th>
            <td><?php echo e(\Carbon\Carbon::parse($penjualan->created_at)->format('d-m-Y H:i:s')); ?></td>
        </tr>
    </tbody>
</table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rpspp\apk.pos.salsa\resources\views/penjualan/show.blade.php ENDPATH**/ ?>