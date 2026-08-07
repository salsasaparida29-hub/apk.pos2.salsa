<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
  <title>@yield('title')</title>

  @vite(['resources/css/app.css','resources/js/app.js'])

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

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>

</html>