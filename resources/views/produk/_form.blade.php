@csrf

@if (!empty($produk->foto))
<div class="mb-3">
    <label class="form-label">Foto Saat Ini</label><br>
    <img src="{{ asset('storage/' . $produk->foto) }}"
         width="150"
         class="img-thumbnail">
</div>
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Gambar</label>
        <input
            type="file"
            name="foto"
            onchange="previewImage(this)"
            class="form-control @error('foto') is-invalid @enderror">

        @error('foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Preview Foto</label><br>
        <img id="preview"
             src="#"
             class="img-thumbnail"
             width="150"
             style="display:none;">
    </div>
</div>

{{-- AWAL KODE TAMBAHAN DROPDOWN JENIS PRODUK --}}
<div class="mb-3">
    <label class="form-label">Jenis Produk</label>
    <select name="jenis_id" class="form-control @error('jenis_id') is-invalid @enderror">
        <option value="">-- Pilih Jenis Produk --</option>
        @foreach($jenis as $item)
            <option value="{{ $item->id }}" {{ old('jenis_id', $produk->jenis_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->nama_jenis }}
            </option>
        @endforeach
    </select>

    @error('jenis_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
{{-- AKHIR KODE TAMBAHAN DROPDOWN JENIS PRODUK --}}

<div class="mb-3">
    <label class="form-label">Nama Produk</label>
    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $produk->nama ?? '') }}">

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Harga Beli</label>
    <input
        type="number"
        name="purchase_price"
        class="form-control @error('purchase_price') is-invalid @enderror"
        value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">

    @error('purchase_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Harga Jual</label>
    <input
        type="number"
        name="selling_price"
        class="form-control @error('selling_price') is-invalid @enderror"
        value="{{ old('selling_price', $produk->harga_jual ?? '') }}">

    @error('selling_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Stok</label>
    <input
        type="number"
        name="stock"
        class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', $produk->stok ?? '') }}">

    @error('stock')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');

    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.style.display = 'block';
    }
}
</script>
