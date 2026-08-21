@extends('layouts.app') 

@section('content')
<div class="bg-light min-vh-100 py-4">
    <div class="container">
        
        <!-- BARIS ATAS: JUDUL DI KIRI, KEMBALI DI UJUNG KANAN -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h3 class="fw-bold text-secondary mb-0">Data Jenis Produk</h3>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary shadow-sm px-3">
                ← Kembali ke Dashboard
            </a>
        </div>

        <!-- BARIS KEDUA: TOMBOL TAMBAH TEPAT DI BAWAH JUDUL -->
        <div class="mb-4">
            <a href="{{ route('jenis.create') }}" class="btn btn-primary px-4 shadow-sm">
                + Tambah Jenis
            </a>
        </div>

        <!-- KARTU TABEL DATA -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary fw-semibold">
                            <tr>
                                <th width="10%" class="py-3 ps-3">#</th>
                                <th class="py-3">Nama Jenis</th>
                                <th width="20%" class="py-3 text-end pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenis as $index => $item)
                            <tr>
                                <td class="py-3 ps-3 fw-medium text-secondary">{{ $index + 1 }}</td>
                                <td class="py-3 fw-semibold text-dark">{{ $item->nama_jenis }}</td>
                                <td class="py-3 text-end pe-3">
                                    <a href="{{ route('jenis.edit', $item->id) }}" class="btn btn-warning btn-sm text-white px-3 me-1">Edit</a>
                                    
                                    <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jenis ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-3">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted fs-6">
                                    Belum ada data jenis produk yang tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
