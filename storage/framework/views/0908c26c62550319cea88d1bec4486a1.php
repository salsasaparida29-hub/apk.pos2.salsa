<?php $__env->startSection('title', 'penjualan'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style>
    /* 1. Tombol Create Atas - Disesuaikan dengan Aksen Ungu Indigo */
    .btn-create-purple {
        background-color: #6a5ae0 !important;
        border-color: #6a5ae0 !important;
        color: #ffffff !important;
        font-weight: 600;
    }
    .btn-create-purple:hover {
        background-color: #5849d6 !important;
        border-color: #5849d6 !important;
        color: #ffffff !important;
    }

    /* 2. Kepala Tabel - Disesuaikan dengan Ungu Muda Pastel */
    .table-thead-purple th {
        background-color: #f3ebff !important;
        color: #6a5ae0 !important;
        font-weight: 700;
        border-bottom: 2px solid #e1d5f5 !important;
    }

    /* 3. Tombol Aksi Kerja - Detail (Biru Lembut), Edit (Kuning Emas), Hapus (Merah Pastel) */
    .btn-action-detail {
        background-color: #e6f0ff !important;
        color: #0d6efd !important;
        border: 1px solid #b3d1ff !important;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-detail:hover {
        background-color: #0d6efd !important;
        color: #ffffff !important;
    }

    .btn-action-edit {
        background-color: #fff9db !important;
        color: #f59f00 !important;
        border: 1px solid #ffe8cc !important;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: #f59f00 !important;
        color: #ffffff !important;
    }

    .btn-action-delete {
        background-color: #fff5f5 !important;
        color: #fa5252 !important;
        border: 1px solid #ffc9c9 !important;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #fa5252 !important;
        color: #ffffff !important;
    }

    /* Pembatas Simbol Garis Vertikal Antar Tombol */
    .action-divider {
        color: #ced4da;
        margin: 0 4px;
        font-weight: 300;
    }
</style>

<div class="container-fluid px-4 mt-3">

<?php if(session('errors')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('errors')); ?>

    </div>
<?php endif; ?>

<!-- Notifikasi sukses sudah bersih total dari file ini -->

<h1 class="fw-bold text-dark mb-3">Halaman penjualan</h1>

<a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-create-purple mb-3 px-4">Create</a>

<form action="<?php echo e(route('penjualan.index')); ?>" method="GET" class="mb-4">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="<?php echo e(request()->search); ?>"
            class="form-control"
            placeholder="Search penjualan">
        <button class="btn btn-outline-secondary px-4" type="submit">
            Search
        </button>
    </div>
</form>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-thead-purple text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">
                    <tr>
                        <th scope="col" class="ps-3 py-3">#</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Kasir</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <th scope="row" class="ps-3 py-3 fw-bold text-secondary"><?php echo e(($sales->firstItem() + $loop->index)); ?></th>
                        <td class="text-dark"><?php echo e($sale->created_at->translatedFormat('d-m-Y- H:i:s')); ?></td>
                        
                        <td class="fw-bold" style="color: #6a5ae0;"><?php echo e($sale->user->name); ?></td>
                        
                        <td class="fw-bold text-dark">Rp. <?php echo e(number_format ($sale->total_pembayaran)); ?></td>
                        <td><span class="badge bg-light text-dark border px-2 py-1"><?php echo e($sale->metode_pembayaran); ?></span></td>
                        <td>
                            <?php if($sale->status == 'COMPLETED'): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">COMPLETED</span>
                            <?php elseif($sale->status == 'OPEN'): ?>
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">OPEN</span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary border px-2 py-1"><?php echo e($sale->status); ?></span>
                            <?php endif; ?>
                        </td>
                        
                        <td class="text-center">
                            <div class="d-inline-flex align-items-center justify-content-center">
                                <a href="<?php echo e(route('penjualan.show', $sale)); ?>" class="btn-action-detail text-decoration-none">
                                    Detail
                                </a>
                                
                                <?php if($sale->status == 'OPEN'): ?>
                                    <span class="action-divider">||</span>
                                    
                                    <a href="<?php echo e(route('penjualan.edit', $sale)); ?>" class="btn-action-edit text-decoration-none">
                                        Edit
                                    </a>
                                    
                                    <span class="action-divider">||</span>
                                    
                                    <form action="<?php echo e(route('penjualan.destroy', $sale)); ?>" method="POST" class="d-inline mb-0">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-action-delete border-0"
                                            onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Data Tidak Ditemukan</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3 px-2">
    <?php echo e($sales->links()); ?>

</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/penjualan/index.blade.php ENDPATH**/ ?>