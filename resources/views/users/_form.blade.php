@csrf

<style>
    /* 1. Pembungkus Area Form Tengah */
    .card-form-custom {
        background: #ffffff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 24px;
        max-width: 700px; /* Lebar ideal agar proporsional di tengah */
    }

    /* 2. Label Input Form */
    .form-label-custom {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 6px;
    }

    /* 3. Efek Fokus Kolom Input - Berwarna Ungu Muda Soft */
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #bfaeff !important;
        box-shadow: 0 0 0 0.25rem rgba(106, 90, 224, 0.15) !important;
    }

    /* 4. Tombol Simpan - Menggunakan Ungu Indigo (#6a5ae0) */
    .btn-save-purple {
        background-color: #6a5ae0 !important;
        border-color: #6a5ae0 !important;
        color: #ffffff !important;
        font-weight: 600;
        padding: 8px 24px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-save-purple:hover {
        background-color: #5849d6 !important;
        border-color: #5849d6 !important;
    }

    /* 5. Tombol Kembali - Menggunakan Abu-abu Slate */
    .btn-cancel-slate {
        background-color: #6c757d !important;
        border-color: #6c757d !important;
        color: #ffffff !important;
        font-weight: 600;
        padding: 8px 24px;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .btn-cancel-slate:hover {
        background-color: #5a6268 !important;
        border-color: #5a6268 !important;
    }
</style>

<!-- Penggunaan mx-auto di bawah ini yang memindahkan form ke posisi tengah layar -->
<div class="card-form-custom mx-auto mt-3 text-start">

    <!-- 1. INPUT NAMA -->
    <div class="mb-4">
        <label class="form-label-custom">Nama</label>
        <input type="text" name="name"
            placeholder=""
            class="form-control form-control-custom @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name ?? '') }}">

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- 2. INPUT EMAIL -->
    <div class="mb-4">
        <label class="form-label-custom">Email</label>
        <input type="email" name="email"
            placeholder=""
            class="form-control form-control-custom @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email ?? '') }}">

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- 3. INPUT PASSWORD -->
    <div class="mb-4">
        <label class="form-label-custom">Password</label>
        <input type="password" name="password"
            placeholder=""
            class="form-control form-control-custom @error('password') is-invalid @enderror">

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- 4. DROPDOWN PILIHAN ROLE (DARI DATABASE) -->
    <div class="mb-4">
        <label class="form-label-custom">Role</label>
        <select name="role_id" class="form-select form-select-custom @error('role_id') is-invalid @enderror">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>

        @error('role_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- 5. TOMBOL AKSI KERJA -->
    <div class="d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-save-purple">Simpan</button>
        <a href="{{ route('admin.users') }}" class="btn btn-cancel-slate">
            Kembali
        </a>
    </div>

</div>
