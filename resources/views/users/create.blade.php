@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="container mt-4">
    <!-- Judul disesuaikan lebar maksimal dan mx-auto agar posisinya presisi di atas kotak form tengah -->
    <h4 class="fw-bold text-dark mx-auto" style="max-width: 700px; text-align: left !important; padding-left: 10px; margin-bottom: 15px;">
        Tambah User
    </h4>

    <form action="{{ route('admin.users.store')}}" method="POST">
        @include('users._form')
    </form>
</div>

@endsection
