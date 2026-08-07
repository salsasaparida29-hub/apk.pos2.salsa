@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">

    <div class="input-group">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search nama produk"
        >

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>

    </div>

</form>

<table class="table">

    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User</th>
            <th scope="col">Foto</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Stok</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($products as $product)

        <tr>

            <th scope="row" class="align-middle">{{ $products->firstItem() + $loop->index }}</th>
            <td class="align-middle">{{ $product->user?->name ?? '-' }}</td>

            <td class="align-middle">
                <img
                    src="{{ asset('storage/' . $product->foto) }}"
                    width="100"
                    class="img-thumbnail"
                >
            </td>

            <td class="align-middle">{{ $product->nama }}</td>
            <td class="align-middle">{{ $product->harga_beli }}</td>
            <td class="align-middle">{{ $product->harga_jual }}</td>
            <td class="align-middle">{{ $product->stok }}</td>

            <!-- PERBAIKAN: d-flex dipindahkan ke dalam div baru agar tombol sejajar lurus di tengah baris -->
            <td class="align-middle">
                <div class="d-flex gap-1 align-items-center">

                    @can('update', $product)
                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">
                        Edit
                    </a>
                    @endcan

                    @can('delete', $product)
                    <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline mb-0">
                        @csrf
                        @method('DELETE')

                        <!-- PERBAIKAN: Ditambahkan type="submit" agar perintah hapus terkirim ke server -->
                        <button
                            type="submit"
                            class="btn btn-danger"
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
            <td colspan="8" class="text-center">
                Data tidak tersedia.
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

{{ $products->links() }}

@endsection
