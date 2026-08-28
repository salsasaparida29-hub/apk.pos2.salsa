@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<style>
    /* 1. Tombol Create Atas - Disesuaikan dengan Aksen Ungu Indigo */
    .btn-create-purple {
        background-color: #6a5ae0 !important;
        border-color: #6a5ae0 !important;
        color: #ffffff !important;
        font-weight: 600;
    }
    .btn-create-purple:hover {
        background-color: #5849d6 !important;
        border-color: #5849d6 !important;
        color: #ffffff !important;
    }

    /* 2. Kepala Tabel - Disesuaikan dengan Ungu Muda Pastel */
    .table-thead-purple th {
        background-color: #f3ebff !important;
        color: #6a5ae0 !important;
        font-weight: 700;
        border-bottom: 2px solid #e1d5f5 !important;
    }

    /* 3. Tombol Aksi Kerja - Edit (Kuning Emas), Hapus (Merah Pastel) */
    .btn-action-edit {
        background-color: #fff9db !important;
        color: #f59f00 !important;
        border: 1px solid #ffe8cc !important;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-edit:hover {
        background-color: #f59f00 !important;
        color: #ffffff !important;
    }

    .btn-action-delete {
        background-color: #fff5f5 !important;
        color: #fa5252 !important;
        border: 1px solid #ffc9c9 !important;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-action-delete:hover {
        background-color: #fa5252 !important;
        color: #ffffff !important;
    }

    /* Pembatas Simbol Garis Vertikal Antar Tombol */
    .action-divider {
        color: #ced4da;
        margin: 0 4px;
        font-weight: 300;
    }
</style>

<div class="container-fluid px-4 mt-3">

<h1 class="fw-bold text-dark mb-3">Halaman Produk</h1>

{{-- PERBAIKAN: Kode alert sukses di bawah ini dihapus agar tidak duplikat dengan layout utama --}}

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create') }}" class="btn btn-create-purple mb-3 px-4">Create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-4">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search nama produk"
        >
        <button class="btn btn-outline-secondary px-4" type="submit">
            Search
        </button>
    </div>
</form>

<div class="card border-0 shadow-sm rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-thead-purple text-uppercase" style="font-size: 12px; letter-spacing: 0.5px;">
                    <tr>
                        <th scope="col" class="ps-3 py-3">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Stok</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <th scope="row" class="ps-3 py-3 fw-bold text-secondary">{{ $products->firstItem() + $loop->index }}</th>
                        <td class="text-muted">{{ $product->user?->name ?? '-' }}</td>

                        <td>
                            @if($product->foto)
                                <img
                                    src="{{ asset('storage/' . $product->foto) }}"
                                    width="60"
                                    class="img-thumbnail"
                                    style="border-radius: 6px;"
                                >
                            @else
                                <span class="badge bg-light text-dark border">No Image</span>
                            @endif
                        </td>

                        <td class="fw-bold text-dark">{{ $product->nama }}</td>
                        <td class="text-secondary">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        
                        <!-- Mengubah Warna Teks Harga Jual menjadi ungu tua tebal yang serasi -->
                        <td class="fw-bold" style="color: #6a5ae0;">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        
                        <!-- Angka Stok otomatis tebal mengikuti warna teks -->
                        <td class="fw-bold text-dark">{{ $product->stok }}</td>

                        <td class="text-center">
                            <div class="d-inline-flex align-items-center justify-content-center">
                                @can('update', $product)
                                <a href="{{ route('produk.edit', $product) }}" class="btn-action-edit text-decoration-none">
                                    Edit
                                </a>
                                @endcan

                                @if(auth()->user()->can('update', $product) && auth()->user()->can('delete', $product))
                                <span class="action-divider">||</span>
                                @endif

                                @can('delete', $product)
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn-action-delete border-0"
                                        onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')"
                                    >
                                        Hapus
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Data tidak tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3 px-2">
    {{ $products->links() }}
</div>

</div>
@endsection
