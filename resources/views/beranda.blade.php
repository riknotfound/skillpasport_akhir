@extends('template')

@section('title', 'Beranda')

@section('content')
<div class="container text-center my-5">
    <h1 class="fw-bold mb-3">Selamat Datang di E-Commerce Sekolah</h1>
    <p class="lead text-muted">Belanja berbagai produk karya siswa dan kebutuhan sekolah dengan mudah dan cepat!</p>
    <a href="#" class="btn btn-primary btn-lg mt-3">Lihat Produk</a>
</div>

<div class="container my-5">
    <h2 class="text-center mb-4">Produk Terbaru</h2>
    <div class="row">
        @foreach ($produk as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="{{ $item['nama'] }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item['nama'] }}</h5>
                        <p class="text-muted">Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
