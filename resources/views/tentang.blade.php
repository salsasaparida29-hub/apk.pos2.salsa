@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

@include('layouts.navbar')

<div class="text-center mt-5">

    <img src="{{ asset('assets/img/img.jpg') }}" 
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
@endsection