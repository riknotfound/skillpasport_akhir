<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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

        .sidebar a:hover {
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

        .header h5 {
            color: #333;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="{{ route('dashboard.admin') }}">Dashboard</a>
        <a href="{{ route('admin.pengguna.index')}}">Pengguna</a>
        <a href="#">Toko</a>
    </div>

    <div class="header">
        <h5 class="m-0">Admin Panel</h5>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
