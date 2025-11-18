@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h2>Tambah Produk</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('member.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                @foreach($categories as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <!-- <div class="mb-3">
            <label>Toko</label>
            <select name="id_toko" class="form-control" required>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->nama_toko }}</option>
                @endforeach
            </select>
        </div> -->

        <div class="mb-3">
            <label>Gambar Produk (boleh lebih dari satu)</label>
            <input type="file" name="gambar_produk[]" class="form-control" accept="image/*" multiple>
            <small class="form-text text-muted">Bisa upload beberapa gambar sekaligus.</small>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('member.produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
