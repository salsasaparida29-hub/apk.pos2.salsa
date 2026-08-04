<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>
    .card-header {
        background-color: #5b52e0;
        color: #ffffff;
        font-weight: 600;
        border-bottom: none;
    }

    .card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .card-body {
        background-color: #ffffff;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
</style>

<div class="text-center mt-5">
    <h1 class="mb-1">
        Ringkasan Hari Ini
        <small class="text-muted" style="font-size: 2rem;">
            (<?php echo e($tanggalHariIni->translatedFormat('1, d F Y')); ?>)
        </small>
    </h1>

    <div class="row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>
            <div class="col-md-12">
                <h4 class="section-title">Today's Sales</h4>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Total Nilai Penjualan Hari Ini
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">Rp <?php echo e(number_format($ringkasan['total_penjualan'])); ?></h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Jumlah Transaksi Hari Ini
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">
                            <?php echo e($ringkasan['total_transaksi']); ?>

                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center mt-5">
            <div class="col-md-12">
                <h4 class="section-title">Cash &amp; Payment Status</h4>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Total Pembayaran Tunai
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">
                            Rp <?php echo e(number_format($ringkasan['total_cash'])); ?>

                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Total Pembayaran Non Tunai
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">
                            Rp <?php echo e(number_format($ringkasan['total_non_tunai'])); ?>

                        </h6>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row mt-5">

        <div class="col-md-12">
            <h4 class="section-title">Critical Inventory Status</h4>
        </div>

        <!-- Produk Stok Rendah -->
        <div class="col-md-6">
            <h6 class="mb-3">Daftar Produk Stok Rendah</h6>

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
            <h6 class="mb-3">Produk Habis Stok</h6>

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

    <div class="row mt-5">
        <div class="col-md-12">
            <h4 class="section-title">Best Seller Products</h4>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rpspp\apk.pos.salsa\resources\views/dashboard.blade.php ENDPATH**/ ?>