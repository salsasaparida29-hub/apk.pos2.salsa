@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="container mt-4">
    <!-- PERBAIKAN: Teks dibuat rata kiri (text-align: left), tetapi letak areanya sejajar di atas kotak form tengah -->
    <h4 class="fw-bold text-dark mx-auto mb-3" style="max-width: 700px; text-align: left !important; padding-left: 2px;">
        Edit Produk
    </h4>

    <form action="{{ route('produk.update', $produk) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('produk._form')

    </form>
</div>

@endsection
