@extends('admin.template')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Produk</h2>

    @if (Auth::user()->role == 'member')
        <a href="{{ route('member.produk.create') }}" class="btn btn-primary mb-3">+ Tambah Produk</a>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Toko</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $i => $product)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $product->nama_produk }}</td>
                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>{{ $product->category->nama_kategori ?? '-' }}</td>
                    <td>{{ $product->store->nama_toko ?? '-' }}</td>
                    <td>{{ $product->tanggal_upload }}</td>
                    <td>
                        @if (Auth::user()->role == "member")
                            <a href="{{ route('member.produk.edit', $product->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                        @endif
                        @if (Auth::user()->role == "member")
                            <form action="{{ route('member.produk.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button  type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @else
                            <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button  type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
