@extends('admin.template')

@section('content')
<div class="container mt-4">
    <h2>Tambah Produk</h2>

    <form action="{{ route('member.produk.store') }}" method="POST">
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
            <label>Kategori</label>
            <select name="id_kategori" class="form-control" required>
                @foreach($categories as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Toko</label>
            <select name="id_toko" class="form-control" required>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->nama_toko }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('member.produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
