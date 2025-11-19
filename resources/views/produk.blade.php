@extends('template')

@section('title', 'Semua Produk')

@section('content')

<div class="container my-4">

    <h2 class="fw-bold mb-4 text-center">Semua Produk</h2>

    <div class="row g-4">

        @forelse ($products as $item)
            <div class="col-md-3 col-sm-6">
                <div class="card h-100 shadow-sm">

                    {{-- Gambar Produk --}}
                    @if ($item->gambarProduk->count() > 0)
                    
                        <img src="{{ asset('image-product/' . $item->gambarProduk->first()->nama_gambar) }}"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image"
                             class="card-img-top"
                             style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_produk }}</h5>

                        <p class="text-primary fw-bold mb-1">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </p>

                        <p class="text-muted small mb-1">
                            {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                        </p>

                        <p class="text-muted small">
                            Toko: {{ $item->toko->nama_toko ?? '-' }}
                        </p>
                    </div>

                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('produk.detail', $item->id) }}"
                           class="btn btn-primary w-100">
                            Detail Produk
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-center mt-4">Belum ada produk tersedia.</p>
        @endforelse

    </div>

</div>

@endsection
