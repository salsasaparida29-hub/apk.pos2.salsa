@extends('layouts.app')

@section('title', 'penjualan')

@section('content')
@include('layouts.navbar')

@if (session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h1>Halaman penjualan</h1>

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Create</a>

<form action="{{ route('penjualan.index')}}" method="GET" class="mb-3">
    <div class="input-group">

        <input
            type="text"
            name="search"
            value="{{ request()->search }}"
            class="form-control"
            placeholder="Search penjualan">

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>

    </div>
</form>

<table class="table">

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Kasir</th>
            <th scope="col">Total Pembayaran</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($sales as $sale)

        <tr>
            <th scope="row" class="align-middle">{{ ($sales->firstItem() + $loop->index) }}</th>
            <td class="align-middle">{{$sale->created_at->translatedFormat('d-m-Y- H:i:s')}}</td>
            <td class="align-middle">{{ $sale->user->name }}</td>
            <td class="align-middle">Rp. {{number_format ($sale->total_pembayaran) }}</td>
            <td class="align-middle">{{ $sale->metode_pembayaran }}</td>
            <td class="align-middle">{{ $sale->status }}</td>
            
            <td class="align-middle">
                <div class="d-flex gap-1 align-items-center">
                    <!-- Tombol Detail -->
                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-primary btn-sm">
                        Detail
                    </a>
                    
                    <span>||</span>
                    
                    <!-- Tombol Edit (Proteksi dicabut agar pasti muncul untuk Kasir) -->
                    <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning btn-sm">
                        Edit
                    </a>
                    
                    <span>||</span>
                    
                    <!-- Tombol Hapus (Proteksi dicabut agar pasti muncul untuk Kasir) -->
                    <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline mb-0">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
        </tr>

        @endforelse

    </tbody>

</table>

{{ $sales->links() }}

@endsection
