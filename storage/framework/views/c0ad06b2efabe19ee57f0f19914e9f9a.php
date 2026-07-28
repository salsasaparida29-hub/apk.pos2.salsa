<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="text-center">
<h1>
Ringkasan Hari Ini
<small class="text-muted">
(<?php echo e($tanggalHariIni->translatedFormat('1, d F Y')); ?>)
</small>
<h1>
<div class="row">
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>
        <div class="col-md-12">
            <h1>Today's Sales</h1>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total Nilai Penjualan Hari Ini
                </div>

                <div class="card-body">
                    <h5 class="card-title">Rp <?php echo e(number_format($ringkasan['total_penjualan'])); ?> </h5>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Jumlah Transaksi Hari Ini
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        <?php echo e($ringkasan['total_transaksi']); ?>

                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total Pembayaran Tunai
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        Rp <?php echo e(number_format($ringkasan['total_cash'])); ?>

                    </h5>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total Pembayaran Non Tunai
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        Rp <?php echo e(number_format($ringkasan['total_non_tunai'])); ?> </h5>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <div class="row mb-4">

        <div class="col-md-12">
            <h1>Critical Inventory Status</h1>
        </div>

        <!-- Produk Stok Rendah -->
        <div class="col-md-6">
            <h3>Daftar Produk Stok Rendah</h3>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($produkStokRendah->firstItem() + $index); ?></td>
                            <td><?php echo e($produk->nama); ?></td>
                            <td><?php echo e($produk->stok); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php echo e($produkStokRendah->links()); ?>

        </div>

        <!-- Produk Stok Habis -->
        <div class="col-md-6">
            <h3>Produk Habis Stok</h3>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($produkStokHabis->firstItem() + $index); ?></td>
                            <td><?php echo e($produk->nama); ?></td>
                            <td><?php echo e($produk->stok); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php echo e($produkStokHabis->links()); ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Best Seller Products</h1>
        </div>

        <div class="col-md-12">
        <table class="table">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Stok</th>
            <th scope="col">Unit Terjual</th>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $produkTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($produk->nama); ?></td>
                <td><?php echo e($produk->stok); ?></td>
                <td><?php echo e($produk->total_terjual); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="3" class="text-muted text-center">
                    Seluruh produk berada dalam kondisi stok aman.
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
   </table>
    </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\pos_salsa\resources\views/dashboard.blade.php ENDPATH**/ ?>