<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Toko Kosmetik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: 100%; justify-content: center;">
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>" aria-current="page" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
        </li>
        
        <?php if(auth()->user()->role_id == 1): ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('admin/users') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users')); ?>">Users</a>
        </li>
        <?php endif; ?>
        <?php if(auth()->user()->role_id == 1): ?>
        <!-- MENU JENIS (SEBELUM PRODUK) -->
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('jenis') ? 'active' : ''); ?>" href="<?php echo e(route('jenis.index')); ?>">Jenis</a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('produk') ? 'active' : ''); ?>" href="<?php echo e(route('produk.index')); ?>">Produk</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('penjualan') ? 'active' : ''); ?>" href="<?php echo e(route('penjualan.index')); ?>">Penjualan</a>
        </li>
      <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('tentang') ? 'active' : ''); ?>" href="<?php echo e(route('tentang')); ?>">Tentang</a>
        </li>
      </ul>

      <div class="d-flex">
        <a href="<?php echo e(route('logout')); ?>" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</nav>
<?php /**PATH C:\apk.pos2.salsa\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>