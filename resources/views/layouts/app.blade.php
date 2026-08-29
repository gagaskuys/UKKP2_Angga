<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard') - Aplikasi Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.85);
            padding: 10px 15px;
            border-radius: 8px;
            display: block;
            margin: 4px 0;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .card-stat {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .navbar-custom {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- SIDEBAR -->
            <div class="col-md-2 sidebar p-3">
                <h4 class="mb-4"><i class="bi bi-shield-check"></i> App Panel</h4>
                <p class="small text-white-50">Hai, {{ auth()->user()->name }}</p>
                <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('profil.edit') }}"><i class="bi bi-person-circle"></i> Profil Saya</a>

                @if(auth()->user()->isAdmin())
                <hr class="text-white-50">
                <small class="text-white-50">ADMIN MENU</small>
                <a href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i> Manajemen User</a>
                <a href="{{ route('admin.kategori.index') }}"><i class="bi bi-tags"></i> Kategori</a>
                <a href="{{ route('admin.pengaduan.index') }}"><i class="bi bi-chat-dots"></i> Pengaduan</a>
                @endif

                @if(auth()->user()->isPetugas())
                <hr class="text-white-50">
                <small class="text-white-50">PETUGAS MENU</small>
                <a href="{{ route('petugas.users.index') }}"><i class="bi bi-people"></i> Data Customer</a>
                <a href="{{ route('petugas.pengaduan.index') }}"><i class="bi bi-chat-dots"></i> Pengaduan</a>
                @endif

                @if(auth()->user()->isCustomer())
                <hr class="text-white-50">
                <small class="text-white-50">CUSTOMER MENU</small>
                <a href="{{ route('customer.pengaduan.index') }}"><i class="bi bi-chat-dots"></i> Pengaduan Saya</a>
                <a href="{{ route('customer.pengaduan.create') }}"><i class="bi bi-plus-circle"></i> Buat Pengaduan</a>
                @endif

                <hr class="text-white-50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light btn-sm w-100">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-md-10 p-4">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>