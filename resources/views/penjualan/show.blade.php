@extends('layouts.app')

@section('content')
<style>
    .pos-detail-wrapper {
        background-color: #f8f9fa !important;
        min-height: 100vh;
        padding: 30px 15px;
    }
    /* Struk ala Alfamart: sempit, font monospace, garis putus-putus */
    .receipt-sheet {
        max-width: 380px;
        margin: 0 auto;
        background-color: #ffffff !important;
        border: 1px solid #e3e6f0 !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06) !important;
        font-family: 'Courier New', Courier, monospace;
    }
    .receipt-dashed {
        border-top: 1px dashed #999;
        margin: 12px 0;
    }
    .receipt-item-row {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-bottom: 2px;
    }
    .receipt-header-store {
        text-align: center;
        font-weight: bold;
        font-size: 16px;
        letter-spacing: 1px;
    }
    .receipt-meta {
        font-size: 12px;
        color: #555;
    }
    .badge-cash {
        background-color: #ffffff !important;
        color: #333333 !important;
        border: 1px solid #ced4da !important;
        font-weight: bold;
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 4px;
    }
</style>

<div class="pos-detail-wrapper">
    <div class="receipt-sheet card">
        <div class="card-body p-4">

            <!-- Tombol Kembali -->
            <div class="text-end mb-2">
                <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-white border px-2 text-secondary" style="background-color: #fff; font-size: 12px; border-radius: 6px;">
                    ← Kembali
                </a>
            </div>

            <!-- Header ala struk toko -->
            <div class="receipt-header-store" style="color: #000;">TOKO KASIR</div>
            <div class="text-center receipt-meta mb-2">Terima kasih telah berbelanja</div>

            <div class="receipt-dashed"></div>

            <!-- Info transaksi -->
            <div class="receipt-meta">
                <div class="receipt-item-row"><span>No. Nota</span><span>#{{ $penjualan->id }}</span></div>
                <div class="receipt-item-row"><span>Kasir</span><span>{{ $penjualan->user->name ?? 'Admin Utama' }}</span></div>
                <div class="receipt-item-row"><span>Tanggal</span><span>{{ $penjualan->created_at->format('d/m/Y H:i') }}</span></div>
                <div class="receipt-item-row"><span>Bayar</span><span class="badge-cash text-uppercase">{{ $penjualan->metode_pembayaran }}</span></div>
            </div>

            <div class="receipt-dashed"></div>

            <!-- Daftar barang -->
            @foreach($penjualan->itemPenjualan as $item)
            @php
                $hargaSatuan = $item->harga ?? $item->harga_satuan ?? $item->produk->harga ?? $item->produk->harga_jual ?? 0;
                if($hargaSatuan == 0 && ($item->subtotal > 0 && ($item->kuantitas ?? 1) > 0)) {
                    $hargaSatuan = $item->subtotal / ($item->kuantitas ?? 1);
                }
                $qty = $item->kuantitas ?? $item->jumlah ?? 0;
                $subtotal = $item->subtotal ?? ($hargaSatuan * $qty);
            @endphp
            <div class="mb-2">
                <div style="font-size: 13px; font-weight: bold;">{{ $item->produk->nama ?? 'Produk Tanpa Nama' }}</div>
                <div class="receipt-item-row" style="color: #555;">
                    <span>{{ $qty }} x {{ number_format($hargaSatuan, 0, ',', '.') }}</span>
                    <span style="font-weight: bold; color: #000;">{{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach

            <div class="receipt-dashed"></div>

            <!-- Total -->
            <div class="receipt-item-row" style="font-size: 15px; font-weight: bold; color: #000;">
                <span>TOTAL</span>
                <span>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</span>
            </div>

            <div class="receipt-dashed"></div>
            <div class="text-center receipt-meta">*** Terima Kasih ***</div>

        </div>
    </div>
</div>
@endsection