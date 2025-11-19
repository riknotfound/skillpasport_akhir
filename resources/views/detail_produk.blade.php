@extends('template')

@section('title', 'Detail Produk')

@section('content')

<div class="container my-4">

    <div class="row">
        
        {{-- Gambar Produk --}}
        <div class="col-md-5">
            @if ($produk->gambarProduk->count() > 0)
                <img src="{{ asset('image-product/' . $produk->gambarProduk->first()->nama_gambar) }}"
                     class="img-fluid rounded shadow-sm">
            @else
                <img src="https://via.placeholder.com/400x300?text=No+Image"
                     class="img-fluid rounded shadow-sm">
            @endif
        </div>

        {{-- Info Produk --}}
        <div class="col-md-7">

            <h2 class="fw-bold">{{ $produk->nama_produk }}</h2>

            <h4 class="text-primary fw-bold">
                Rp {{ number_format($produk->harga, 0, ',', '.') }}
            </h4>

            <p class="text-muted">
                Kategori: {{ $produk->kategori->nama_kategori ?? '-' }}
            </p>

            <p class="text-muted">
                Toko: {{ $produk->toko->nama_toko ?? '-' }}
            </p>

            <p class="mt-3">
                {{ $produk->deskripsi }}
            </p>

            <a href="https://wa.me/6287750778257" class="btn btn-success mt-4">Order via WhatsApp</a>
            <a href="{{ route('produk.all') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>

    </div>

</div>

@endsection
