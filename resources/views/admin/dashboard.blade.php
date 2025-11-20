@extends('admin.template')
@section('title', 'Dashboard Admin')
@section('menu-dashboard', 'active')
@section('content')

<div class="text-center mb-5">
    <h3 class="fw-bold">
        Selamat Datang, {{ Auth::user()->nama }}
    </h3>
    <p class="mb-0">
        Gunakan menu navigasi di atas untuk mengelola data sesuai hak akses Anda.
    </p>
</div>

<div class="d-flex flex-wrap justify-content-center gap-4">

    {{-- CARD UNTUK ADMIN --}}
    @if (Auth::user()->role === 'admin')

        {{-- CARD TOKO --}}
        <div class="card shadow-sm border-0 text-center" style="width: 230px;">
            <div class="card-body">
                <h5 class="card-title">Total Toko</h5>
                <h2 class="fw-bold">{{ $totalToko ?? 0 }}</h2>
                <a href="{{ url('/admin/toko') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
            </div>
        </div>

        {{-- CARD PENGGUNA --}}
        <div class="card shadow-sm border-0 text-center" style="width: 230px;">
            <div class="card-body">
                <h5 class="card-title">Total Pengguna</h5>
                <h2 class="fw-bold">{{ $totalPengguna ?? 0 }}</h2>
                <a href="{{ url('/admin/pengguna') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
            </div>
        </div>

        {{-- CARD PRODUK (SEMUA TOKO) --}}
        <div class="card shadow-sm border-0 text-center" style="width: 230px;">
            <div class="card-body">
                <h5 class="card-title">Total Produk</h5>
                <h2 class="fw-bold">{{ $totalProdukAll ?? 0 }}</h2>
                <a href="{{ url('/admin/produk') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
            </div>
        </div>

    @endif

    {{-- CARD UNTUK MEMBER --}}
    @if (Auth::user()->role === 'member')

        {{-- CARD PRODUK (khusus toko member) --}}
        <div class="card shadow-sm border-0 text-center" style="width: 230px;">
            <div class="card-body">
                <h5 class="card-title">Total Produk</h5>
                <h2 class="fw-bold">{{ $totalProduk ?? 0 }}</h2>
                <a href="{{ url('/member/produk') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
            </div>
        </div>

        {{-- CARD KATEGORI --}}
        <div class="card shadow-sm border-0 text-center" style="width: 230px;">
            <div class="card-body">
                <h5 class="card-title">Total Kategori</h5>
                <h2 class="fw-bold">{{ $totalKategori ?? 0 }}</h2>
                <a href="{{ url('/member/kategori') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
            </div>
        </div>

    @endif

</div>

@endsection

@section('footer-info')
    <strong>Official E-Coomers SMAN 1 Bandung</strong>
@endsection
