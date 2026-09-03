<?php echo csrf_field(); ?>

<style>
    /* 1. Pembungkus Area Form Tengah */
    .card-form-custom {
        background: #ffffff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 24px;
        max-width: 700px; /* Lebar ideal agar proporsional di tengah */
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

    <!-- 1. INPUT NAMA -->
    <div class="mb-4">
        <label class="form-label-custom">Nama</label>
        <input type="text" name="name"
            placeholder=""
            class="form-control form-control-custom <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            value="<?php echo e(old('name', $user->name ?? '')); ?>">

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

    <!-- 2. INPUT EMAIL -->
    <div class="mb-4">
        <label class="form-label-custom">Email</label>
        <input type="email" name="email"
            placeholder=""
            class="form-control form-control-custom <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            value="<?php echo e(old('email', $user->email ?? '')); ?>">

        <?php $__errorArgs = ['email'];
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

    <!-- 3. INPUT PASSWORD -->
    <div class="mb-4">
        <label class="form-label-custom">Password</label>
        <input type="password" name="password"
            placeholder=""
            class="form-control form-control-custom <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

        <?php $__errorArgs = ['password'];
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

    <!-- 4. DROPDOWN PILIHAN ROLE (DARI DATABASE) -->
    <div class="mb-4">
        <label class="form-label-custom">Role</label>
        <select name="role_id" class="form-select form-select-custom <?php $__errorArgs = ['role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="">-- Pilih Role --</option>
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($role->id); ?>" <?php if(old('role_id', $user->role_id ?? '') == $role->id): echo 'selected'; endif; ?>>
                    <?php echo e(ucfirst($role->name)); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <?php $__errorArgs = ['role_id'];
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

    <!-- 5. TOMBOL AKSI KERJA -->
    <div class="d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-save-purple">Simpan</button>
        <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-cancel-slate">
            Kembali
        </a>
    </div>

</div>
<?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/users/_form.blade.php ENDPATH**/ ?>