<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(session('errors')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('errors')); ?>

    </div>
<?php endif; ?>

<h4 class="mb-3">
    <?php echo e($mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan'); ?>

</h4>

<div class="row">


<div class="col-md-6">
    <div class="card">
        <div class="card-body" style="max-height:70vh; overflow:auto">
            <div class="mb-3">
                <form method="GET" action="<?php echo e(route('penjualan.create')); ?>">
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
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                    <div class="col-7">
                        <button class="btn btn-outline-primary w-100 text-start p-2 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                            <div class="d-flex align-items-center gap-2">
                                <img src="<?php echo e(asset('storage/' . $product->foto)); ?>"
                                    alt="Gambar"
                                    class="rounded-circle"
                                    style="width:45px; height:45px; object-fit:cover;">

                                <div>
                                    <div class="fw-semibold"><?php echo e($product->nama); ?></div>
                                    <small class="text-muted"><?php echo e(number_format($product->harga_jual)); ?></small>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-3">
                        <input type="number" name="quantity" value="1" min="1"
                            class="form-control <?php echo e($sale->status === 'COMPLETED' ? 'readonly' : ''); ?>">
                    </div>

                    <div class="col-2">
                        <button class="btn btn-primary w-100 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">+</button>
                    </div>
                </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<div class="col-md-6">
    <div class="card">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($item->produk->nama); ?></td>
                    <td>Rp.<?php echo e(number_format($item->produk->harga_jual)); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('itempenjualan.update', $item->id)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="number" name="quantity"
                                value="<?php echo e($item->kuantitas); ?>"
                                class="form-control form-control-sm">
                        </form>
                    </td>
                    <td>Rp.<?php echo e(number_format($item->subtotal)); ?></td>
                    <td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $item)): ?>
                        <form method="POST" action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Keranjang kosong</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="card-footer">
            <strong>Rp <?php echo e(number_format($sale->total_pembayaran)); ?></strong>

            <form method="POST"
                action="<?php echo e(route('penjualan.update', $sale->id)); ?>"
                onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <select name="payment_method" class="form-select mb-2">
                    <option value="">Pilih Pembayaran</option>
                    <option value="CASH">Cash</option>
                    <option value="QRIS">QRIS</option>
                </select>
                <button class="btn btn-success w-100 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                    Checkout
                </button>
            </form>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
            <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>"
                method="POST"
                onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-outline-danger w-100 mt-2 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                    Batal Transaksi
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rpspp\apk.pos.salsa\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>