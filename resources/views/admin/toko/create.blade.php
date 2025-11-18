@extends('admin.template')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Toko</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.toko.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_toko" class="form-label">Nama Toko</label>
            <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="{{ old('nama_toko') }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label for="id_user" class="form-label">Pemilik (User)</label>
            <select name="id_user" id="id_user" class="form-select" required>
                <option value="">-- Pilih Pemilik --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected(old('id_user') == $user->id)>{{ $user->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kontak_toko" class="form-label">Kontak Toko</label>
            <input type="text" name="kontak_toko" id="kontak_toko" class="form-control" value="{{ old('kontak_toko') }}" maxlength="13" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
        </div>

        <a href="{{ route('admin.toko.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
