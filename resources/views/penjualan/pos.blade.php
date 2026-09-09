@extends('layouts.app')

@section('title', 'POS')

@section('content')
@include('layouts.navbar')

@if(session('errors'))
    <div class="alert alert-danger mt-2">
        {{ session('errors') }}
    </div>
@endif

<h4 class="mb-3 mt-3">
    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
</h4>

<div class="row">

{{-- ================ PRODUK ================ --}}
<div class="col-md-6">
    <div class="card shadow-sm">
        <div class="card-body" style="max-height:70vh; overflow:auto">
            <div class="mb-3">
                <form method="GET" action="{{ $mode === 'edit' ? route('penjualan.edit', $sale->id) : route('penjualan.create') }}">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari produk..."
                        onkeyup="this.form.submit()">
                </form>
            </div>
            @foreach ($products as $product)

                <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                    @csrf
                    <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="col-7">
                        <button type="submit" class="btn btn-outline-primary w-100 text-start p-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ asset('storage/' . $product->foto) }}"
                                    alt="Gambar"
                                    class="rounded-circle"
                                    style="width:45px; height:45px; object-fit:cover;"
                                    onerror="this.src='https://placeholder.com'">

                                <div>
                                    <div class="fw-semibold">{{ $product->nama }}</div>
                                    <small class="text-muted">Rp {{ number_format($product->harga_jual) }}</small>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-3">
                        <input type="number" name="quantity" value="1" min="1" class="form-control">
                    </div>

                    <div class="col-2">
                        <button type="submit" class="btn btn-primary w-100">+</button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</div>

{{-- ================ KERANJANG ================ --}}
<div class="col-md-6">
    <div class="card shadow-sm">
        <table class="table table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th width="20%">Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale->itemPenjualan as $item)
                <tr>
                    <td>{{ $item->produk->nama ?? 'Produk Terhapus' }}</td>
                    <td>Rp {{ number_format($item->produk->harga_jual ?? 0) }}</td>
                    <td>
                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                            @csrf @method('PUT')
                            <input type="number" name="quantity"
                                value="{{ $item->kuantitas ?? $item->jumlah ?? 1 }}"
                                class="form-control form-control-sm text-center"
                                onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>Rp {{ number_format($item->subtotal ?? 0) }}</td>
                    <td>
                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}" onsubmit="return confirm('Hapus item dari keranjang?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Keranjang kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Total Nilai Belanja:</span>
                <strong class="fs-5 text-success">Rp {{ number_format($sale->total_pembayaran) }}</strong>
            </div>

            {{-- ===== FORM CHECKOUT (Cash & QRIS) ===== --}}
            <form method="POST"
                id="form-checkout"
                action="{{ route('penjualan.update', $sale->id) }}"
                onsubmit="return validasiSebelumSubmit()" class="mt-2">
                @csrf
                @method('PUT')

                <select name="payment_method" id="payment_method" class="form-select mb-2" required onchange="toggleMetodePembayaran()">
                    <option value="">Pilih Pembayaran</option>
                    <option value="CASH" {{ $sale->metode_pembayaran === 'CASH' ? 'selected' : '' }}>Cash</option>
                    <option value="QRIS" {{ $sale->metode_pembayaran === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                </select>

                {{-- Area Cash --}}
                <div id="area_cash" style="display:none;" class="mb-2">
                    <label class="form-label">Uang Diterima</label>
                    <input type="number" name="uang_masuk" id="uang_masuk" class="form-control" placeholder="0" oninput="hitungKembalian()">
                    <p class="mt-2 mb-0">Kembalian: <b id="kembalian_text">Rp 0</b></p>
                </div>

                {{-- Area QRIS (auto-generate, tanpa gambar statis) --}}
                <div id="area_qris" style="display:none; text-align:center;" class="mb-2">
                    <div id="qrcode" class="d-flex justify-content-center my-2"></div>
                    <p class="text-muted mt-2">Scan untuk membayar Rp {{ number_format($sale->total_pembayaran) }}</p>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Selesaikan Transaksi
                </button>
            </form>

            {{-- ===== FORM BATAL TRANSAKSI ===== --}}
            <form action="{{ route('penjualan.destroy', $sale->id) }}"
                method="POST"
                class="mt-2"
                onsubmit="return confirm('Yakin ingin membatalkan dan menghapus seluruh nota transaksi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger w-100">
                    Batal Transaksi
                </button>
            </form>
        </div>
    </div>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
const totalBelanja = {{ $sale->total_pembayaran }};

function toggleMetodePembayaran() {
    const metode = document.getElementById('payment_method').value;
    document.getElementById('area_cash').style.display = 'none';
    document.getElementById('area_qris').style.display = 'none';

    if (metode === 'CASH') {
        document.getElementById('area_cash').style.display = 'block';
    } else if (metode === 'QRIS') {
        document.getElementById('area_qris').style.display = 'block';
        generateQrCode();
    }
}

function generateQrCode() {
    const el = document.getElementById('qrcode');
    el.innerHTML = ''; // reset biar nggak dobel
    new QRCode(el, {
        text: `PEMBAYARAN-QRIS|ID:{{ $sale->id }}|TOTAL:${totalBelanja}`,
        width: 200,
        height: 200
    });
}

function hitungKembalian() {
    const uangMasuk = parseInt(document.getElementById('uang_masuk').value) || 0;
    const kembalian = uangMasuk - totalBelanja;
    document.getElementById('kembalian_text').innerText =
        'Rp ' + (kembalian >= 0 ? kembalian : 0).toLocaleString('id-ID');
}

function validasiSebelumSubmit() {
    const metode = document.getElementById('payment_method').value;

    if (metode === 'CASH') {
        const uangMasuk = parseInt(document.getElementById('uang_masuk').value) || 0;
        if (uangMasuk < totalBelanja) {
            alert('Uang yang diberikan kurang dari total belanja');
            return false;
        }
    }

    return confirm('Yakin ingin memproses checkout transaksi ini?');
}

document.addEventListener('DOMContentLoaded', toggleMetodePembayaran);
</script>
@endsection