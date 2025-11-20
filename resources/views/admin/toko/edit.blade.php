@extends('admin.template')

@section('title', 'Edit Toko')
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Toko</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.toko.update', $toko->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Preview gambar -->
        <div class="mb-3">
            <label class="form-label d-block">Preview Gambar Saat Ini</label>
            <div style="max-width: 360px;">
                <img
                    src="{{ $toko->gambar ? asset('storage/' . $toko->gambar) : '/mnt/data/Screenshot 2025-11-20 064735.png' }}"
                    alt="Preview Gambar Toko"
                    class="img-fluid rounded border"
                    style="width:100%; object-fit:cover;"
                    onerror="this.onerror=null;this.src='/mnt/data/Screenshot 2025-11-20 064735.png';"
                >
            </div>
        </div>

        <div class="mb-3">
            <label for="nama_toko" class="form-label">Nama Toko</label>
            <input type="text" name="nama_toko" id="nama_toko"
                   value="{{ old('nama_toko', $toko->nama_toko) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $toko->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="mb-3">
            <label for="kontak_toko" class="form-label">Kontak Toko</label>
            <input type="text" name="kontak_toko" id="kontak_toko"
                   value="{{ old('kontak_toko', $toko->kontak_toko) }}"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3">{{ old('alamat', $toko->alamat) }}</textarea>
        </div>

        <!-- hidden id_user (jika perlu dikirim, tapi biasanya tidak diubah dari backend) -->
        <input type="hidden" name="id_user" value="{{ old('id_user', $toko->id_user) }}">

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.toko.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
