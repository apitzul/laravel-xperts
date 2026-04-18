<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background: #1f2937;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #374151;
        }

        .content {
            flex: 1;
            padding: 20px;
            background: #f3f4f6;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="sidebar">
        <h2>Admin</h2>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.companies.index') }}">Companies</a>
        <a href="{{ route('admin.employees.index') }}">Employees</a>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
                <button type="submit"
        style="
            margin-top:20px;
            width:100%;
            background:#dc2626;
            color:white;
            padding:10px;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-weight:bold;
            transition:0.2s;
        "
        onmouseover="this.style.background='#b91c1c'"
        onmouseout="this.style.background='#dc2626'">
        🚪 Logout
    </button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
