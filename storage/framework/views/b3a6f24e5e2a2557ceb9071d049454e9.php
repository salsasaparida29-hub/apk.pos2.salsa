<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
  <title><?php echo $__env->yieldContent('title'); ?></title>

  <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

  <style>
      html, body {
          min-height: 100vh;
      }

      body {
          background-color: #f8f9fa;
      }

      /* Notifikasi welcome/success disesuaikan dengan tema ungu-indigo halaman login */
      .alert-success {
          background-color: #efeafd;
          color: #4c3fb0;
          border: 1px solid #cbbdf5;
          border-radius: 8px;
      }

      /* Navbar disamakan aksennya dengan tombol Login (indigo) */
      .navbar {
          border-bottom: 1px solid #e2e6ee;
      }

      .navbar .nav-link.active,
      .navbar .nav-link:hover {
          color: #6a5ae0 !important;
      }

      .btn-danger {
          background-color: #e0507a;
          border-color: #e0507a;
      }

      .btn-danger:hover {
          background-color: #c94169;
          border-color: #c94169;
      }
  </style>
</head>
<body>

<div class="container-fluid px-4">

    <!-- PERBAIKAN UTAMA: Mengaktifkan kembali alert session agar notifikasi selamat datang muncul -->
    <?php if(session('success')): ?>
        <div class="alert alert-success mt-3 p-3">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?> 

    <?php echo $__env->yieldContent('content'); ?>

</div>

</body>

</html>
<?php /**PATH C:\laragon\www\apk.pos2.salsa\resources\views/layouts/app.blade.php ENDPATH**/ ?>