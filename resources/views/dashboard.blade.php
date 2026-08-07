@extends('layouts.app')

@section('title','Dashboard')

@section('content')

@include('layouts.navbar')

<style>
    .card-header {
        background-color: #7c6fe0;
        color: #ffffff;
        font-weight: 600;
        border-bottom: none;
    }

    .card {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    .card-body {
        background-color: #ffffff;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
</style>

<div class="text-center mt-4">
    <h1 class="mb-1">
        Ringkasan Hari Ini
        <small class="text-muted" style="font-size: 2rem;">
            ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
        </small>
    </h1>

    <div class="row">
        @can('viewAny', App\Models\User::class)
            <div class="col-md-12">
                <h4 class="section-title">Today's Sales</h4>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        Total Nilai Penjualan Hari Ini
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">Rp {{ number_format($ringkasan['total_penjualan']) }}</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Jumlah Transaksi Hari Ini
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">
                            {{ $ringkasan['total_transaksi'] }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-12">
                <h4 class="section-title">Cash &amp; Payment Status</h4>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Total Pembayaran Tunai
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">
                            Rp {{ number_format($ringkasan['total_cash']) }}
                        </h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        Total Pembayaran Non Tunai
                    </div>

                    <div class="card-body">
                        <h6 class="card-title mb-0">
                            Rp {{ number_format($ringkasan['total_non_tunai']) }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <div class="row mt-4">

        <div class="col-md-12">
            <h4 class="section-title">Critical Inventory Status</h4>
        </div>

        <!-- Produk Stok Rendah -->
        <div class="col-md-6">
            <h6 class="mb-3">Daftar Produk Stok Rendah</h6>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($produkStokRendah as $index => $produk)
                        <tr>
                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $produkStokRendah->links() }}
        </div>

        <!-- Produk Stok Habis -->
        <div class="col-md-6">
            <h6 class="mb-3">Produk Habis Stok</h6>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($produkStokHabis as $index => $produk)
                        <tr>
                            <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $produkStokHabis->links() }}
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h4 class="section-title">Best Seller Products</h4>
        </div>

        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Unit Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkTerlaris as $produk)
                        <tr>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->total_terjual }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection