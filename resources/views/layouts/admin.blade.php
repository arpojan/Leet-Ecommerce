<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LEET Admin Dashboard</title>
    <link rel="icon" href="{{ asset('assets/logo/logo_leet.png') }}" type="image/png">
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Bootstrap CSS --}}
    <link href="{{ asset('bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --sidebar-width: 250px;
            --primary-bg: #f4f6f9;
            --sidebar-bg: #1e1e2d;
            --sidebar-color: #9899ac;
            --sidebar-active: #ffffff;
            --sidebar-active-bg: #1b1b29;
            --accent: #c9a84c;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            overflow-x: hidden;
            color: #3f4254;
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        #sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #sidebar .sidebar-header img {
            width: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 2px solid var(--accent);
            padding: 2px;
            background: white;
        }

        #sidebar .sidebar-header h4 {
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: 1px;
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul li {
            padding: 5px 15px;
        }

        #sidebar ul li a {
            padding: 12px 15px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            color: var(--sidebar-color);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }

        #sidebar ul li a i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        #sidebar ul li a:hover, #sidebar ul li.active > a {
            color: var(--sidebar-active);
            background: var(--sidebar-active-bg);
        }

        #sidebar ul li.active > a i {
            color: var(--accent);
        }

        /* Main Content Styling */
        #content {
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
        }

        /* Top Header */
        .top-header {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .main-container {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            margin-bottom: 30px;
        }
        
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #f0f0f0;
            padding: 20px 25px;
            font-weight: 600;
            color: #1a1a2e;
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 25px;
        }
    </style>
</head>
<body>
    
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('assets/logo/logo_leet.png') }}" alt="LEET Logo">
                <h4>LEET ADMIN</h4>
            </div>

            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                    <a href="{{ route('admin') }}">
                        <i class="bi bi-box-seam"></i> Manajemen Produk
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.transaksi') || request()->routeIs('admin.transaksi.detail') ? 'active' : '' }}">
                    <a href="{{ route('admin.transaksi') }}">
                        <i class="bi bi-cart-check"></i> Pesanan / Transaksi
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Top Header -->
            <div class="top-header">
                <div class="d-flex align-items-center">
                    <h5 class="m-0 fw-bold text-dark">@yield('page-title', 'Dashboard')</h5>
                </div>
                <div>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/icon/profile_icon.png') }}" alt="Admin" width="32" height="32" class="rounded-circle me-2 border">
                            <strong>{{ Auth::check() ? Auth::user()->name : 'Administrator' }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Container -->
            <div class="main-container">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('bootstrap-5/js/bootstrap.bundle.min.js') }}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- SweetAlert Notifications --}}
    @if(session('success'))
    <script>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
    </script>
    @endif
    @if(session('error'))
    <script>
        Swal.fire({ icon: 'error', title: 'Oops!', text: '{{ session('error') }}', timer: 2500, showConfirmButton: false });
    </script>
    @endif
</body>
</html>