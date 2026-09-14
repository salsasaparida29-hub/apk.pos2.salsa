<?php $__env->startSection('title', 'Tentang Kami'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="text-center mt-5">

    <img src="<?php echo e(asset('assets/img/img.jpg')); ?>" 
         alt="Foto Profil" 
         class="rounded-circle shadow" 
         width="200" 
         height="200"
         style="object-fit: cover;">


    <h1 class="mt-4 fw-bold">Toko Kosmetik</h1>

    <p class="mt-3">
        Selamat datang di <strong>[Toko Kosmetik]</strong>, toko kosmetik dan skincare yang menyediakan berbagai
        produk perawatan kulit dan kecantikan berkualitas. Kami berkomitmen menghadirkan produk
        skincare yang aman, terpercaya, dan sesuai kebutuhan kulit Anda.
    </p>

    <p>
        Aplikasi Point of Sale ini dibuat untuk memudahkan pengelolaan data produk, jenis produk, dan
        transaksi penjualan di toko kami.
    </p>

    <p class="mt-4 fw-bold"> Alamat: Jl. HZ. Mustofa No.6, Kota Tasikmalaya, Jawa Barat</p>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/tentang.blade.php ENDPATH**/ ?>