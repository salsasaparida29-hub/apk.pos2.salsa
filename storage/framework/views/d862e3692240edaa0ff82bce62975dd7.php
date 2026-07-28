<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Pos</a>

        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>"
                        href="<?php echo e(route('dashboard')); ?>">

                        Dashboard

                    </a>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('users*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('users')); ?>">

                        Users

                    </a>
                </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\Produk::class)): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('produk*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('produk.index')); ?>">

                        Produk

                    </a>
                </li>
                <?php endif; ?>

            </ul>

            <form class="d-flex" action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <button type="submit" class="btn btn-danger">
                    Logout
                </button>

            </form>

        </div>
    </div>
</nav>
<?php /**PATH C:\Users\user\pos_salsa\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>