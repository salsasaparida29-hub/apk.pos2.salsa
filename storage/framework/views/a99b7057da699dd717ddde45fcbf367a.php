<?php $__env->startSection('content'); ?>
<style>
    /* Mengatur latar belakang halaman abu-abu tipis dan membatasi lebar lembar utama */
    .pos-detail-wrapper {
        background-color: #f8f9fa !important;
        min-height: 100vh;
        padding: 30px 15px;
    }
    /* Lembaran putih kasir yang pas di tengah (tidak kebesaran) */
    .compact-sheet {
        max-width: 650px;
        margin: 0 auto;
        background-color: #ffffff !important;
        border: 1px solid #e3e6f0 !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04) !important;
    }
    .badge-cash {
        background-color: #ffffff !important;
        color: #333333 !important;
        border: 1px solid #ced4da !important;
        font-weight: bold;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 6px;
    }
</style>

<div class="pos-detail-wrapper">
    <div class="compact-sheet card">
        <div class="card-body p-4">
            
            <!-- Bagian Atas: Judul & Tombol Kembali Ringkas -->
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5 class="fw-bold text-dark mb-1">Rincian Transaksi</h5>
                    <span class="text-muted small">ID Nota: #<?php echo e($penjualan->id); ?></span>
                </div>
                <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-sm btn-white border px-3 text-secondary" style="background-color: #fff; font-size: 13px; border-radius: 6px;">
                    ← Kembali
                </a>
            </div>

            <!-- Blok Data Informasi Kasir (Berjejer Rapi) -->
            <div class="row g-2 mb-4 pb-3 border-bottom text-dark" style="font-size: 14px;">
                <div class="col-sm-4 text-muted">Petugas Kasir</div>
                <div class="col-sm-8 fw-bold text-end text-sm-start">: <?php echo e($penjualan->user->name ?? 'Admin Utama'); ?></div>
                
                <div class="col-sm-4 text-muted">Waktu Transaksi</div>
                <div class="col-sm-8 text-end text-sm-start">: <?php echo e($penjualan->created_at->format('d M Y - H:i')); ?> WIB</div>
                
                <div class="col-sm-4 text-muted d-flex align-items-center">Metode Bayar</div>
                <div class="col-sm-8 text-end text-sm-start">
                    <span class="ms-0 ms-sm-2 d-inline-block align-middle">: <span class="badge-cash text-uppercase"><?php echo e($penjualan->metode_pembayaran); ?></span></span>
                </div>
            </div>

            <!-- Tabel Daftar Produk yang Dibeli -->
            <div class="table-responsive mb-4">
                <table class="table align-middle mb-0" style="font-size: 14px;">
                    <thead class="table-light text-secondary text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-2 py-2">Nama Barang</th>
                            <th class="text-center py-2" width="20%">Qty</th>
                            <th class="text-end pe-2 py-2" width="30%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $penjualan->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $hargaSatuan = $item->harga ?? $item->harga_satuan ?? $item->produk->harga ?? $item->produk->harga_jual ?? 0;
                            if($hargaSatuan == 0 && ($item->subtotal > 0 && ($item->kuantitas ?? 1) > 0)) {
                                $hargaSatuan = $item->subtotal / ($item->kuantitas ?? 1);
                            }
                            $qty = $item->kuantitas ?? $item->jumlah ?? 0;
                            $subtotal = $item->subtotal ?? ($hargaSatuan * $qty);
                        ?>
                        <tr>
                            <td class="py-3 ps-2">
                                <span class="fw-semibold text-dark d-block"><?php echo e($item->produk->nama ?? 'Produk Tanpa Nama'); ?></span>
                                <small class="text-muted" style="font-size: 11px;">@Rp <?php echo e(number_format($hargaSatuan, 0, ',', '.')); ?></small>
                            </td>
                            <td class="text-center fw-medium text-secondary"><?php echo e($qty); ?> pcs</td>
                            <td class="text-end fw-bold text-dark pe-2">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Bagian Bawah: Total Pembayaran Menyeluruh -->
            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <span class="text-muted text-uppercase fw-bold" style="font-size: 12px; letter-spacing: 0.5px;">TOTAL BAYAR</span>
                <h2 class="text-primary fw-bolder mb-0" style="font-size: 28px; color: #0d6efd !important;">
                    Rp <?php echo e(number_format($penjualan->total_pembayaran, 0, ',', '.')); ?>

                </h2>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\apk.pos2.salsa\resources\views/penjualan/show.blade.php ENDPATH**/ ?>