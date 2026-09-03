@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="container mt-4">
    <!-- Menambahkan class text-center dan membatasi lebar maksimal agar sejajar dengan form -->
    <h4 class="fw-bold text-dark text-center mx-auto" style="max-width: 700px; text-align: left !important; padding-left: 10px;">
        Tambah Produk
    </h4>

    <form action="{{ route('produk.store')}}"
          method="POST"
          enctype="multipart/form-data">
        @include('Produk._form')
    </form>
</div>

@endsection
