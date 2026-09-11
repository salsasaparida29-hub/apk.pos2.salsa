<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Toko Kosmetik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="width: 100%; justify-content: center;">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        
        @if(auth()->user()->role_id == 1)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users') ? 'active' : ''}}" href="{{ route('admin.users') }}">Users</a>
        </li>
        @endif

        <!-- MENU JENIS (SEBELUM PRODUK) -->
        <li class="nav-item">
          <a class="nav-link {{ Request::is('jenis') ? 'active' : ''}}" href="{{ route('jenis.index') }}">Jenis</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk') ? 'active' : ''}}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link {{ Request::is('penjualan') ? 'active' : ''}}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      <li class="nav-item">
          <a class="nav-link {{ Request::is('tentang') ? 'active' : ''}}" href="{{ route('tentang') }}">Tentang</a>
        </li>
      </ul>

      <div class="d-flex">
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</nav>
