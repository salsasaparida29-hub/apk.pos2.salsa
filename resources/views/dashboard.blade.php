@extends('layouts.app')

@section('title','Dashboard')

@section('content')

@include('layouts.navbar')

<div class="text-center">
<h1>
Ringkasan Hari Ini
<small class="text-muted">
({{ $tanggalHariIni->translatedFormat('1, d F Y') }})
</small>
<h1>
<div class="row">
@can('viewAny', App\Models\User::class)
        <div class="col-md-12">
            <h1>Today's Sales</h1>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total Nilai Penjualan Hari Ini
                </div>

                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }} </h5>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Jumlah Transaksi Hari Ini
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        {{ $ringkasan['total_transaksi'] }}
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total Pembayaran Tunai
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        Rp {{ number_format($ringkasan['total_cash']) }}
                    </h5>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total Pembayaran Non Tunai
                </div>

                <div class="card-body">
                    <h5 class="card-title">
                        Rp {{ number_format($ringkasan['total_non_tunai']) }} </h5>
                </div>
            </div>
        </div>
    </div>
@endcan
    <div class="row mb-4">

        <div class="col-md-12">
            <h1>Critical Inventory Status</h1>
        </div>

        <!-- Produk Stok Rendah -->
        <div class="col-md-6">
            <h3>Daftar Produk Stok Rendah</h3>

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
            <h3>Produk Habis Stok</h3>

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
    <div class="row">
        <div class="col-md-12">
            <h1>Best Seller Products</h1>
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
