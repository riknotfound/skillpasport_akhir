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

{{-- Gunakan flexbox agar kartu center --}}
<div class="d-flex flex-wrap justify-content-center gap-4">

    {{-- CARD TOKO - hanya admin --}}
    @if (Auth::user()->role === 'admin')
    <div class="card shadow-sm border-0 text-center" style="width: 230px;">
        <div class="card-body">
            <h5 class="card-title">Total Toko</h5>
            <h2 class="fw-bold">{{ $totalToko ?? 0 }}</h2>
            <a href="{{ url('/admin/toko') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
        </div>
    </div>

    {{-- CARD PENGGUNA - hanya admin --}}
    <div class="card shadow-sm border-0 text-center" style="width: 230px;">
        <div class="card-body">
            <h5 class="card-title">Total Pengguna</h5>
            <h2 class="fw-bold">{{ $totalPengguna ?? 0 }}</h2>
            <a href="{{ url('/admin/pengguna') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
        </div>
    </div>
    @endif

    {{-- CARD PRODUK - hanya member --}}
    <div class="card shadow-sm border-0 text-center" style="width: 230px;">
        <div class="card-body">
            <h5 class="card-title">Total Produk</h5>
            <h2 class="fw-bold">{{ $totalProduk ?? 0 }}</h2>
            <a href="{{ url('/member/produk') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
        </div>
    </div>

    {{-- CARD KATEGORI - hanya member --}}
    <div class="card shadow-sm border-0 text-center" style="width: 230px;">
        <div class="card-body">
            <h5 class="card-title">Total Kategori</h5>
            <h2 class="fw-bold">{{ $totalKategori ?? 0 }}</h2>
            <a href="{{ url('/member/kategori') }}" class="btn btn-primary btn-sm mt-2">Lihat Data</a>
        </div>
    </div>

    {{-- CARD EKSKUL --}}
    {{-- <div class="card shadow-sm border-0 text-center" style="width: 230px;">
        <div class="card-body">
            <h5 class="card-title">Total Ekskul</h5>
            <h2 class="fw-bold">{{ $totalEkskul ?? 0 }}</h2>
            <a href="{{ Auth::user()->level === 'admin' ? url('/admin/ekstrakurikuler') : url('/operator/ekstrakurikuler') }}"
               class="btn btn-primary btn-sm mt-2">Lihat Data</a>
        </div>
    </div> --}}

</div>

@endsection

@section('footer-info')
    <strong>Dashboard SMPN 1 Harapan Rakyat</strong>
@endsection