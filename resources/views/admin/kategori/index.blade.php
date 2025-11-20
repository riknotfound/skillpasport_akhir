@extends('admin.template')
@section('content')
<div class="container py-4">
    <h3 class="mb-4">Daftar Kategori</h3>

    @if ($categories->isEmpty())
        <div class="alert alert-info">Belum ada kategori tersedia.</div>
    @else

        <table class="table" style="border: 1px solid #ddd;">
            <thead class="table-dark">
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Kategori</th>
                    <th style="width: 180px;">Tanggal Dibuat</th>
                    <th style="width: 180px;">Terakhir Update</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $index => $kategori)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->created_at ? $kategori->created_at->format('Y-m-d') : '-' }}</td>
                        <td>{{ $kategori->updated_at ? $kategori->updated_at->format('Y-m-d') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
</div>
@endsection
