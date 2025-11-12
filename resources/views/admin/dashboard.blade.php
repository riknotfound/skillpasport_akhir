@extends('admin.template')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Selamat Datang di Dashboard Admin 👋</h1>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="display-6 text-primary">125</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Kategori</h5>
                    <p class="display-6 text-success">8</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="display-6 text-warning">53</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-dark text-white">Aktivitas Terbaru</div>
        <div class="card-body">
            <ul>
                <li>Admin menambahkan produk baru: <strong>Roti Coklat</strong></li>
                <li>Pengguna baru mendaftar: <strong>ucup123</strong></li>
                <li>Kategori <strong>Minuman</strong> diperbarui</li>
            </ul>
        </div>
    </div>
</div>
@endsection
