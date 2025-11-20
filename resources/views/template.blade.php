<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce Sekolah')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">E-School</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('produk') ? 'active' : '' }}" href="{{ route('produk.all') }}">Produk</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('toko') ? 'active' : '' }}" href="{{ route('toko.public') }}">Toko</a></li>
                </ul>

                <!-- SEARCH FORM (menggunakan GET ke route produk) -->
                <form class="d-flex" role="search" method="GET" action="{{ route('produk.all') }}">
                    <input
                        class="form-control me-2"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari produk..."
                        aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
                </form>

                <ul class="navbar-nav ms-3">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    <main class="flex-grow-1 py-4">
        @yield('content')
    </main>

    {{-- FOOTER MIRIP UNIPIN --}}
    <footer class="bg-dark text-white pt-5 pb-4 mt-auto">
        <div class="container">

            <!-- Bagian Atas -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4 class="fw-bold mb-2">E-SCHOOL</h4>
                    <p>Dapatkan Penawaran Terbaik Sekarang!</p>

                    <!-- Sosial Media -->
                    <div class="d-flex gap-3 fs-4">
                        <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/shiariik/" class="text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>

            <hr class="border-secondary">

            <!-- Link Section -->
            <div class="row text-start">

                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">E-School</h5>
                    <p class="text-secondary small">
                        Platform pembayaran & marketplace sekolah untuk membantu siswa membeli
                        kebutuhan digital maupun fisik dengan mudah.
                    </p>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold mb-3">Product & Service</h5>
                    <ul class="list-unstyled small text-secondary">
                        <li><a href="#" class="text-white text-decoration-none">Game</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Voucher</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Fashion</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Berbagai Makanan</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold mb-3">Support & Information</h5>
                    <ul class="list-unstyled small text-secondary">
                        <li><a href="#" class="text-white text-decoration-none">Media</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Promo & Acara</a></li>
                        <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Dukungan Pelanggan</a></li>
                    </ul>
                </div>

                <div class="col-md-2 mb-4">
                    <h5 class="fw-bold mb-3">Corporate</h5>
                    <ul class="list-unstyled small text-secondary">
                        <li><a href="#" class="text-white text-decoration-none">Tentang</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Kemitraan</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Affiliates</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Status</a></li>
                    </ul>
                </div>

            </div>

            <hr class="border-secondary">

            <!-- Copyright -->
            <div class="text-center text-secondary small">
                &copy; {{ date('Y') }} E-School. Semua Hak Dilindungi.
            </div>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
