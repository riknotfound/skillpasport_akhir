@extends('admin.template')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Toko</h2>

    <a href="{{ route('admin.toko.create') }}" class="btn btn-primary mb-3">+ Tambah Toko</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Toko</th>
                <th>Deskripsi</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th>Pemilik</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stores as $i => $store)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $store->nama_toko }}</td>
                    <td>{{ $store->deskripsi }}</td>
                    <td>{{ $store->kontak_toko }}</td>
                    <td>{{ $store->alamat }}</td>
                    <td>{{ $store->user->nama ?? '-' }}</td>
                    <td>{{ $store->created_at }}</td>

                    <td>
                        <a href="{{ route('admin.toko.edit', $store->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>

                        <form action="{{ route('admin.toko.destroy', $store->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus toko ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada toko.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
