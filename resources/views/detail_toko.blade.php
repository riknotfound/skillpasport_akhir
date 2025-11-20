@extends('template')

@section('content')

<div class="container mt-4">

    {{-- Header toko --}}
    <div class="text-center mb-4">
        <img src="{{ $store->gambar ? asset('storage/'.$store->gambar) : '/no-image.png' }}"
             class="rounded-circle"
             style="width:140px; height:140px; object-fit:cover;">

        <h2 class="fw-bold mt-3">{{ $store->nama_toko }}</h2>

        <p class="text-muted">{{ $store->deskripsi }}</p>

        <p class="mb-0"><strong>Alamat:</strong> {{ $store->alamat }}</p>
        <p class="mb-3"><strong>Kontak:</strong> {{ $store->kontak_toko }}</p>
    </div>

    <hr>

    <h4 class="fw-bold mb-3">Produk di Toko Ini</h4>

    @if ($store->produks->count() == 0)
        <p class="text-muted">Belum ada produk.</p>
    @endif

    <div class="row">
        @foreach ($store->produks as $produk)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">

                    <img src="
                    @if ($produk->images->count() > 0)
                        {{ asset('image-product/' . $produk->images->first()->nama_gambar) }}
                    @else
                        /no-image.png
                    @endif
                    "
                    class="card-img-top"
                    style="height:170px; object-fit:cover;">

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $produk->nama_produk }}</h5>

                        <p class="small text-muted mb-1">
                            {{ Str::limit($produk->deskripsi, 60) }}
                        </p>

                        <p class="fw-bold">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('produk.detail', $produk->id) }}"
                           class="btn btn-primary btn-sm w-100">
                            Detail Produk
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
