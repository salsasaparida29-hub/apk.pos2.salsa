<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('errors')): ?>
    <div class="alert alert-danger mt-2">
        <?php echo e(session('errors')); ?>

    </div>
<?php endif; ?>

<h4 class="mb-3 mt-3">
    <?php echo e($mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan'); ?>

</h4>

<div class="row">


<div class="col-md-6">
    <div class="card shadow-sm">
        <div class="card-body" style="max-height:70vh; overflow:auto">
            <div class="mb-3">
                <form method="GET" action="<?php echo e($mode === 'edit' ? route('penjualan.edit', $sale->id) : route('penjualan.create')); ?>">
                    <input type="text"
                        name="search"
                        value="<?php echo e(request('search')); ?>"
                        class="form-control"
                        placeholder="Cari produk..."
                        onkeyup="this.form.submit()">
                </form>
            </div>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                <form method="POST" action="<?php echo e(route('itempenjualan.store')); ?>" class="row mb-2">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="penjualan_id" value="<?php echo e($sale->id); ?>">
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                    <div class="col-7">
                     
                        <button type="submit" class="btn btn-outline-primary w-100 text-start p-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="<?php echo e(asset('storage/' . $product->foto)); ?>"
                                    alt="Gambar"
                                    class="rounded-circle"
                                    style="width:45px; height:45px; object-fit:cover;"
                                    onerror="this.src='https://placeholder.com'">

                                <div>
                                    <div class="fw-semibold"><?php echo e($product->nama); ?></div>
                                    <small class="text-muted">Rp <?php echo e(number_format($product->harga_jual)); ?></small>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-3">
                        <input type="number" name="quantity" value="1" min="1" class="form-control">
                    </div>

                    <div class="col-2">
                     
                        <button type="submit" class="btn btn-primary w-100">+</button>
                    </div>
                </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="card shadow-sm">
        <table class="table table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th width="20%">Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($item->produk->nama ?? 'Produk Terhapus'); ?></td>
                    <td>Rp <?php echo e(number_format($item->produk->harga_jual ?? 0)); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('itempenjualan.update', $item->id)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="number" name="quantity"
                                value="<?php echo e($item->kuantitas ?? $item->jumlah ?? 1); ?>"
                                class="form-control form-control-sm text-center"
                                onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>Rp <?php echo e(number_format($item->subtotal ?? 0)); ?></td>
                    <td>
                        
                        <form method="POST" action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>" onsubmit="return confirm('Hapus item dari keranjang?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Keranjang kosong</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Total Nilai Belanja:</span>
                <strong class="fs-5 text-success">Rp <?php echo e(number_format($sale->total_pembayaran)); ?></strong>
            </div>

            <form method="POST"
                action="<?php echo e(route('penjualan.update', $sale->id)); ?>"
                onsubmit="return confirm('Yakin ingin memproses checkout transaksi ini?')" class="mt-2">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <select name="payment_method" class="form-select mb-2" required>
                    <option value="">Pilih Pembayaran</option>
                    <option value="CASH" <?php echo e($sale->metode_pembayaran === 'CASH' ? 'selected' : ''); ?>>Cash</option>
                    <option value="QRIS" <?php echo e($sale->metode_pembayaran === 'QRIS' ? 'selected' : ''); ?>>QRIS</option>
                </select>
            
                <button type="submit" class="btn btn-success w-100">
                    Selesaikan Transaksi 
                </button>
            </form>
            <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>"
                method="POST"
                class="mt-2"
                onsubmit="return confirm('Yakin ingin membatalkan dan menghapus seluruh nota transaksi ini?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-outline-danger w-100">
                    Batal Transaksi 
                </button>
            </form>
        </div>
    </div>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\apk.pos2.salsa\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>