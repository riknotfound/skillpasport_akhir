@extends('admin.template')

@section('content')
<div class="container">
    <h2>Edit Produk</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('member.produk.update', $produk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
            <input type="date" name="tanggal_upload" id="tanggal_upload" value="{{ old('tanggal_upload', $produk->tanggal_upload) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="id_kategori" class="form-label">Kategori</label>
            <select name="id_kategori" id="id_kategori" class="form-select">
                @foreach($categories as $kategori)
                    <option value="{{ $kategori->id }}" {{ $produk->id_kategori == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- <div class="mb-3">
            <label for="id_toko" class="form-label">Toko</label>
            <select name="id_toko" id="id_toko" class="form-select">
                @foreach($stores as $toko)
                    <option value="{{ $toko->id }}" {{ $produk->id_toko == $toko->id ? 'selected' : '' }}>
                        {{ $toko->nama_toko }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('member.produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
