<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Point Of Sale</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>" aria-current="page" href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('admin/users') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users')); ?>">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('produk') ? 'active' : ''); ?>" href="<?php echo e(route('produk.index')); ?>">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(Request::is('penjualan') ? 'active' : ''); ?>" href="<?php echo e(route('penjualan.index')); ?>">Penjualan</a>
        </li>
      </ul>

      <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-flex">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>
  </div>
</nav><?php /**PATH C:\Users\rpspp\apk.pos.salsa\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>