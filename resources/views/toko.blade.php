@extends('template')

@section('content')

<div class="container mt-4">
    <h2 class="fw-bold mb-4">Daftar Toko</h2>

    <div class="row">
        @foreach ($stores as $store)
            <div class="col-12 mb-4">
                <div class="card shadow-sm d-flex flex-row align-items-center p-3">

                    {{-- Gambar Toko Lingkaran --}}
                    <div class="me-3">
                        @if ($store->gambar)
                            <img src="{{ asset('storage/' . $store->gambar) }}"
                                class="rounded-circle"
                                style="width:100px; height:100px; object-fit:cover;">
                        @else
                            <img src="/no-image.png"
                                class="rounded-circle"
                                style="width:100px; height:100px; object-fit:cover;">
                        @endif
                    </div>

                    {{-- Info Toko --}}
                    <div class="flex-grow-1">
                        <h5 class="fw-bold mb-1">{{ $store->nama_toko }}</h5>
                        <p class="small text-muted mb-2">{{ Str::limit($store->deskripsi, 80) }}</p>

                        <a href="{{ route('toko.detail', $store->id) }}"
                           class="btn btn-primary">
                            Kunjungi Toko
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
