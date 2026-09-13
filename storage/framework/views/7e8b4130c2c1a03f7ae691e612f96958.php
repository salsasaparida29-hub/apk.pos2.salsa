<?php $__env->startSection('title', 'Users'); ?>

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

    /* 3. Tombol Aksi Kerja - Edit Akun (Biru Lembut), Hapus (Merah Pastel) */
    .btn-action-edit {
        background-color: #e6f0ff !important;
        color: #0d6efd !important;
        border: 1px solid #b3d1ff !important;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: #0d6efd !important;
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

<h1 class="fw-bold text-dark mb-3">Halaman Users</h1>
<a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-create-purple mb-3 px-4">Create</a>

<form action="<?php echo e(route('admin.users')); ?>" method="GET" class="mb-4">
    <div class="input-group">
        <input
        type="text"
        name="search"
        value="<?php echo e(request('search')); ?>"
        class="form-control"
        placeholder="Search username or email"
        >
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
                      <th scope="col" class="ps-3 py-3" width="5%">#</th>
                      <th scope="col" width="30%">Name</th>
                      <th scope="col" width="30%">Email</th>
                      <th scope="col" width="15%">Role</th>
                      <th scope="col" class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="ps-3 py-3 fw-bold text-secondary"><?php echo e($users->firstItem() + $loop->index); ?></td>
                        
                        <!-- Mengubah warna teks nama pengguna menjadi gelap tegas -->
                        <td class="fw-bold text-dark"><?php echo e($user->name); ?></td>
                        <td class="text-secondary"><?php echo e($user->email); ?></td>
                        <td>
                            <!-- Menampilkan badge role kasir sewarna ungu muda kustom -->
                            <?php if($user->role->name == 'admin' || $user->role_id == 1): ?>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1" style="border-radius: 4px;">admin</span>
                            <?php else: ?>
                                <span class="badge px-2 py-1" style="border-radius: 4px; color: #6a5ae0 !important; background-color: #f3ebff !important; border-color: #e1d5f5 !important; border: 1px solid;">kasir</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="d-inline-flex align-items-center justify-content-center">
                                <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn-action-edit text-decoration-none">
                                    Edit Akun
                                </a>
                                
                                <span class="action-divider">||</span>
                                
                                <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" class="d-inline mb-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn-action-delete border-0" onclick="return confirm('Yakin hapus user ini')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3 px-2">
    <?php echo e($users->links()); ?>

</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\apk.pos2.salsa\resources\views/users/index.blade.php ENDPATH**/ ?>