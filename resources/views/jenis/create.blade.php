@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: #6a5ae0;">
                    <h5 class="mb-0">Tambah Jenis Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('jenis.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_jenis" class="form-label">Nama Jenis</label>
                            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis') }}">
                            @error('nama_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn text-white" style="background-color: #6a5ae0;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection