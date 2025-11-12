<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            overflow-x: hidden;
        }
        .sidebar {
            width: 250px;
            background: #212529;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 60px;
            transition: all 0.3s;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #343a40;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar.collapsed a span {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button id="toggleSidebar" class="btn btn-outline-light btn-sm me-3">☰</button>
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}"><span></span> <span>Dashboard</span></a>
        <a href="#"><span></span> <span>Produk</span></a>
        <a href="#"><span></span> <span>Kategori</span></a>
        <a href="#"><span></span> <span>Pengguna</span></a>
        <a href="#"><span></span> <span>Pengaturan</span></a>
    </div>

    <!-- Content -->
    <div class="content" id="content">
        @yield('content')
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            if (sidebar.classList.contains('collapsed')) {
                content.style.marginLeft = "70px";
            } else {
                content.style.marginLeft = "250px";
            }
        });
    </script>
</body>
</html>
