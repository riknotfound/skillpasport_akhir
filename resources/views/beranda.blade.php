@extends('template')

@section('title', 'Beranda')

@section('content')

{{-- HERO / DARK OVERLAY --}}
<div class="hero-section position-relative d-flex align-items-center text-center text-white"
    style="background: url('{{ asset('assets/background.jpg') }}') center/cover no-repeat; height: 60vh;">
    <div style="position:absolute; inset:0; background:rgba(0,0,0,0.55);"></div>

    <div class="container position-relative">
        <h1 class="fw-bold mb-3">Selamat Datang di E-Commerce Sekolah</h1>
        <p class="lead">Belanja berbagai produk karya siswa dan kebutuhan sekolah dengan mudah dan cepat!</p>
        <a href="/produk" class="btn btn-primary btn-lg mt-3">Lihat Produk</a>
    </div>
</div>

{{-- PRODUK TERBARU --}}
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold">Produk Terbaru</h2>

    <div class="row">
        @foreach ($produk as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0" style="border-radius:14px; overflow:hidden;">

                    {{-- Gambar --}}
                    @php
                        $firstImage = $item->gambarProduk->first();
                        $imgUrl = $firstImage ? asset('image-product/' . $firstImage->nama_gambar) : 'https://via.placeholder.com/400x250';
                    @endphp

                    <img src="{{ $imgUrl }}"
                         class="card-img-top"
                         style="height:230px; object-fit:cover;">

                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $item->nama_produk }}</h5>
                        <p class="text-muted mb-1">
                            Rp{{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <p class="text-secondary" style="font-size: 0.85rem;">
                            Kategori: {{ $item->kategori->nama_kategori ?? '-' }}
                        </p>

                        <a href="/produk" class="btn btn-outline-primary btn-sm rounded-pill px-4">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- KATEGORI PRODUK --}}
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold">Kategori</h2>

    <div class="row justify-content-center g-3">
        @foreach ($kategori as $cat)
            <div class="col-md-3">
                <div class="card shadow-sm text-center p-4 border-0"
                     style="border-radius:16px; background:#f8f9fa;">
                    <h5 class="fw-bold mb-2">{{ $cat->nama_kategori }}</h5>
                    <a href="#" class="btn btn-primary btn-sm rounded-pill px-4">Lihat Produk</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
