@extends('admin.template')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Selamat Datang di Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="display-6 text-primary">{{ $totalProduk }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-2">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Toko</h5>
                    <p class="display-6 text-success">{{ $totalToko }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-2">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Kategori</h5>
                    <p class="display-6 text-success">{{ $totalKategori }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-2">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="display-6 text-warning">{{ $totalPengguna }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
