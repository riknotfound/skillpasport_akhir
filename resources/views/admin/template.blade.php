<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100%;
            background-color: #ffffff;
            border-right: 1px solid #ddd;
            padding-top: 60px;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #555;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #e9ecef;
            color: #000;
        }

        .header {
            position: fixed;
            top: 0;
            left: 220px;
            right: 0;
            height: 60px;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .content {
            margin-left: 220px;
            padding: 80px 25px 25px;
        }

        .logout-btn {
            background: none;
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        {{-- Dashboard --}}
        <a href="{{ Auth::user()->role === 'admin' ? url('/admin') : url('/member') }}"
           class="@yield('menu-dashboard')">Dashboard</a>

        {{-- Menu ADMIN --}}
        @if (Auth::user()->role === 'admin')
            <a href="{{ url('/admin/toko') }}" class="@yield('menu-toko')">Toko</a>
            <a href="{{ url('/admin/pengguna') }}" class="@yield('menu-pengguna')">Pengguna</a>
            <a href="{{ url('/admin/produk') }}" class="@yield('menu-produk')">Produk</a>

        {{-- Menu MEMBER --}}
        @elseif (Auth::user()->role === 'member')
            <a href="{{ url('/member/produk') }}" class="@yield('menu-produk')">Produk</a>
            <a href="{{ url('/member/kategori') }}" class="@yield('menu-kategori')">Kategori</a>
        @endif
    </div>

    {{-- Header --}}
    <div class="header">
        <h5 class="m-0">{{ Auth::user()->role === 'admin' ? 'Admin Panel' : 'Member Panel' }}</h5>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    {{-- Main Content --}}
    <div class="content">
        @yield('content')
    </div>

    <footer class="text-center py-3">
        @hasSection('footer-info')
            <div class="mb-2">
                @yield('footer-info')
            </div>
        @endif
        <small>&copy; {{ date('Y') }} {{ Auth::user()->role === 'admin' ? 'Admin' : 'Member' }} E-Coomers School</small>
    </footer>

</body>
</html>