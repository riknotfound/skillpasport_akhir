@extends('member.template')

@section('title', 'Beranda Member')

@section('content')

{{-- HERO SECTION --}}
<div class="position-relative" style="height: 50vh;">
    <img src="{{ asset('assets/background.jpg') }}" 
         class="w-100 h-100" 
         style="object-fit: cover; filter: brightness(45%);"
         alt="Background">

    <div class="position-absolute top-50 start-50 translate-middle text-center text-white">
        <h1 class="fw-bold">Selamat Datang, {{ auth()->user()->name }}</h1>
        <p class="lead mt-2">Temukan berbagai produk sekolah dengan mudah!</p>
        <a href="#" class="btn btn-primary btn-lg mt-3">Mulai Belanja</a>
    </div>
</div>

{{-- PRODUK TERBARU --}}
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold">Produk Terbaru</h2>

    <div class="row">
        @forelse ($produk as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    {{-- gambar produk --}}
                    @if($item->gambarProduk->first())
                        <img src="{{ asset('storage/'.$item->gambarProduk->first()->path) }}"
                             class="card-img-top"
                             style="height: 230px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/400x250"
                             class="card-img-top"
                             alt="gambar-produk">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->nama_produk }}</h5>
                        <p class="text-muted">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>

                        <a href="#" class="btn btn-outline-primary btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Belum ada produk.</p>
        @endforelse
    </div>
</div>

{{-- KATEGORI --}}
<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold">Kategori Produk</h2>

    <div class="row justify-content-center g-4">
        @forelse ($kategori as $cat)
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm border-0">
                    <h5 class="fw-bold mb-2">{{ $cat->nama_kategori }}</h5>
                    <a href="#" class="btn btn-primary btn-sm">Lihat Produk</a>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Kategori tidak tersedia.</p>
        @endforelse
    </div>
</div>

@endsection
