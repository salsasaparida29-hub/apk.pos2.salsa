@extends('layouts.app')

@section('content')
{{-- Menggunakan container-fluid agar tata letak melebar otomatis menyesuaikan lebar layar laptop --}}
<div class="container-fluid px-4 mt-3">
    
    <!-- Header Halaman Minimalis Modern -->
    <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
        <div>
            <h4 class="fw-bold mb-1 text-secondary">Detail Transaksi Penjualan</h4>
            <span class="badge bg-light text-dark border">ID Nota: #{{ $penjualan->id }}</span>
        </div>
        <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-outline-secondary px-3">
            <i class="bi bi-arrow-left"></i> Kembali ke Halaman Penjualan
        </a>
    </div>

    <!-- Kotak Informasi Utama & Pembayaran (Lebar Fleksibel) -->
    <div class="row g-4 mb-4">
        <!-- Blok Kiri: Data Transaksi -->
        <div class="col-xl-6 col-md-12">
            <div class="card h-100 border-light-subtle shadow-sm">
                <div class="card-body">
                    <h6 class="card-subtitle mb-3 text-muted fw-bold text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Ringkasan Nota</h6>
                    <div class="row g-2">
                        <div class="col-sm-4 text-muted">Nama Kasir</div>
                        <div class="col-sm-8 fw-semibold">: {{ $penjualan->user->name ?? 'Tidak Diketahui' }}</div>
                        
                        <div class="col-sm-4 text-muted">Waktu Transaksi</div>
                        <div class="col-sm-8">: {{ $penjualan->created_at->format('d M Y - H:i') }} WIB</div>
                        
                        <div class="col-sm-4 text-muted">Status Nota</div>
                        <div class="col-sm-8">: 
                            @if($penjualan->status === 'COMPLETED')
                                <span class="badge bg-success-subtle text-success border border-success-subtle py-1 px-2">Selesai</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle py-1 px-2">{{ $penjualan->status }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blok Kanan: Finansial -->
        <div class="col-xl-6 col-md-12">
            <div class="card h-100 border-light-subtle shadow-sm bg-body-tertiary">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h6 class="card-subtitle mb-2 text-muted fw-bold text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Total Pembayaran</h6>
                    <h1 class="text-success fw-bolder mb-2" style="font-size: calc(1.5rem + 1vw);">
                        Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                    </h1>
                    <div class="text-muted border-top pt-2" style="font-size: 13px;">
                        Metode Pembayaran: <span class="fw-bold text-dark">{{ $penjualan->metode_pembayaran }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Produk Lebar Penuh -->
    <div class="card border-light-subtle shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 fw-bold text-secondary text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">Produk yang Dibeli</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0" style="font-size: 14px;">
                    <thead class="table-light border-bottom text-muted text-uppercase" style="font-size: 12px;">
                        <tr>
                            <th width="5%" class="text-center py-3">No</th>
                            <th>Nama Produk</th>
                            <th width="18%" class="text-end">Harga Satuan</th>
                            <th width="15%" class="text-center">Kuantitas</th>
                            <th width="20%" class="text-end pe-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjualan->itemPenjualan as $index => $item)
                        <tr>
                            <td class="text-center py-3 text-muted">{{ $index + 1 }}</td>
                            <td>
                                <span class="fw-semibold text-dark d-block">{{ $item->produk->nama ?? $item->produk->nama_produk ?? 'Produk Tanpa Nama' }}</span>
                                <small class="text-muted" style="font-size: 11px;">ID Produk: {{ $item->produk->id ?? $item->produk_id ?? '-' }}</small>
                            </td>
                            <td class="text-end text-secondary">
                                @php
                                    // Hitung otomatis jika harga bernilai 0 di tabel item penjualan
                                    $hargaSatuan = $item->harga ?? $item->harga_satuan ?? $item->produk->harga ?? $item->produk->harga_jual ?? 0;
                                    if($hargaSatuan == 0 && ($item->subtotal > 0 && ($item->kuantitas ?? $item->jumlah ?? $item->qty) > 0)) {
                                        $hargaSatuan = $item->subtotal / ($item->kuantitas ?? $item->jumlah ?? $item->qty);
                                    }
                                @endphp
                                Rp {{ number_format($hargaSatuan, 0, ',', '.') }}
                            </td>
                            <td class="text-center fw-medium text-dark">
                                {{ $item->kuantitas ?? $item->jumlah ?? $item->qty ?? 0 }} pcs
                            </td>
                            <td class="text-end fw-bold text-dark pe-4">
                                @php
                                    $qty = $item->kuantitas ?? $item->jumlah ?? $item->qty ?? 0;
                                    $subtotal = $item->subtotal ?? ($hargaSatuan * $qty);
                                @endphp
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Tidak ada rincian produk untuk transaksi ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-light fw-semibold text-secondary">
                        <tr class="border-top">
                            <td colspan="3" class="text-end py-3">Jumlah Keseluruhan Item:</td>
                            <td class="text-center text-dark fw-bold">
                                {{ $penjualan->itemPenjualan->sum('kuantitas') ?: $penjualan->itemPenjualan->sum('jumlah') ?: $penjualan->itemPenjualan->sum('qty') ?: 0 }} Pcs
                            </td>
                            <td></td>
                        </tr>
                        <tr class="table-group-divider border-top-0">
                            <td colspan="4" class="text-end text-dark py-3 fw-bold">Total Pembayaran Akhir:</td>
                            <td class="text-end text-success fs-5 fw-bolder pe-4">
                                Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
