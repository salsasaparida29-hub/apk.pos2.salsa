<?php echo csrf_field(); ?>

<style>
    /* 1. Pembungkus Area Form - Ditambahkan mx-auto agar posisi ke tengah */
    .card-form-custom {
        background: #ffffff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 24px;
        max-width: 700px; /* Sedikit dikecilkan agar proporsi di tengah terlihat sangat pas */
    }

    /* 2. Label Input Form */
    .form-label-custom {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 6px;
    }

    /* 3. Efek Fokus Kolom Input - Berwarna Ungu Muda Soft */
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #bfaeff !important;
        box-shadow: 0 0 0 0.25rem rgba(106, 90, 224, 0.15) !important;
    }

    /* 4. Tombol Simpan - Menggunakan Ungu Indigo (#6a5ae0) */
    .btn-save-purple {
        background-color: #6a5ae0 !important;
        border-color: #6a5ae0 !important;
        color: #ffffff !important;
        font-weight: 600;
        padding: 8px 24px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-save-purple:hover {
        background-color: #5849d6 !important;
        border-color: #5849d6 !important;
    }

    /* 5. Tombol Kembali - Menggunakan Abu-abu Slate */
    .btn-cancel-slate {
        background-color: #6c757d !important;
        border-color: #6c757d !important;
        color: #ffffff !important;
        font-weight: 600;
        padding: 8px 24px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-cancel-slate:hover {
        background-color: #5a6268 !important;
        border-color: #5a6268 !important;
    }
</style>

<!-- Penggunaan mx-auto di bawah ini yang memindahkan form ke posisi tengah layar -->
<div class="card-form-custom mx-auto mt-3 text-start">

    <!-- 1. BLOK FOTO SAAT INI (HANYA MUNCUL DI MODE EDIT) -->
    <?php if(!empty($produk->foto)): ?>
    <div class="mb-4">
        <label class="form-label-custom">Foto Saat Ini</label><br>
        <img src="<?php echo e(asset('storage/' . $produk->foto)); ?>"
             width="150"
             class="img-thumbnail rounded-3 shadow-sm">
    </div>
    <?php endif; ?>

    <!-- 2. BLOK INPUT GAMBAR BARU DAN PREVIEW (Sudah disinkronkan ke name="gambar") -->
    <div class="row mb-4">
        <div class="col-md-6">
            <label class="form-label-custom">Gambar</label>
            <input
                type="file"
                name="gambar"
                onchange="previewImage(this)"
                class="form-control form-control-custom <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

            <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">
                    <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="col-md-6">
            <label class="form-label-custom">Preview Foto</label><br>
            <img id="preview"
                 src="#"
                 class="img-thumbnail rounded-3 shadow-sm"
                 width="150"
                 style="display:none; max-height: 150px; object-fit: contain;">
        </div>
    </div>

    <!-- 3. DROPDOWN JENIS PRODUK -->
    <div class="mb-4">
        <label class="form-label-custom">Jenis Produk</label>
        <select name="jenis_id" class="form-select form-select-custom <?php $__errorArgs = ['jenis_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="">-- Pilih Jenis Produk --</option>
            <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($item->id); ?>" <?php echo e(old('jenis_id', $produk->jenis_id ?? '') == $item->id ? 'selected' : ''); ?>>
                    <?php echo e($item->nama_jenis); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <?php $__errorArgs = ['jenis_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback">
                <?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- 4. INPUT NAMA PRODUK -->
    <div class="mb-4">
        <label class="form-label-custom">Nama Produk</label>
        <input
            type="text"
            name="name"
            placeholder="Masukkan nama produk"
            class="form-control form-control-custom <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            value="<?php echo e(old('name', $produk->nama ?? '')); ?>">

        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback">
                <?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- 5. INPUT HARGA BELI -->
    <div class="mb-4">
        <label class="form-label-custom">Harga Beli</label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted">Rp</span>
            <input
                type="number"
                name="purchase_price"
                placeholder="0"
                class="form-control form-control-custom <?php $__errorArgs = ['purchase_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('purchase_price', $produk->harga_beli ?? '')); ?>">
            <?php $__errorArgs = ['purchase_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">
                    <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- 6. INPUT HARGA JUAL -->
    <div class="mb-4">
        <label class="form-label-custom">Harga Jual</label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted">Rp</span>
            <input
                type="number"
                name="selling_price"
                placeholder="0"
                class="form-control form-control-custom <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('selling_price', $produk->harga_jual ?? '')); ?>">
            <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">
                    <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <!-- 7. INPUT STOK -->
    <div class="mb-4">
        <label class="form-label-custom">Stok</label>
        <input
            type="number"
            name="stock"
            placeholder="0"
            class="form-control form-control-custom <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            value="<?php echo e(old('stock', $produk->stok ?? '')); ?>">

        <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback">
                <?php echo e($message); ?>

            </div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <!-- 8. TOMBOL AKSI KERJA -->
    <div class="d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-save-purple">Simpan</button>
        <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-cancel-slate">Kembali</a>
    </div>

</div>

<!-- JavaScript Render Pratinjau Gambar -->
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    } else {
        preview.src = "#";
        preview.style.display = 'none';
    }
}
</script>
<?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/Produk/_form.blade.php ENDPATH**/ ?>