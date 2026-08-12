<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Akun Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Left Section / Banner wrapper */
        .new-arrivals-wrapper {
            background-color: #ffffff;
            border: 1px solid #eaeaea;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            height: 100%;
        }
        
        .new-arrivals-img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        
        .new-arrivals-img:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        
        /* Custom List Group item hover */
        .custom-list-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent !important;
        }
        
        .custom-list-item:hover {
            background-color: #f8f9fa;
            border-left: 3px solid #0d6efd !important;
            padding-left: 1.5rem !important;
        }
    </style>
</head>
<body>
    @include('layouts.app.navbar')

    <div class="container mt-5 mb-5">
        <h2 class="text-center fw-bold mb-4" style="color: #2c3e50;">Akun Saya</h2>
        
        <div class="row g-4 align-items-stretch">
            <!-- Banners Section (Left) -->
            <div class="col-lg-5 col-xl-6">
                <div class="new-arrivals-wrapper d-flex align-items-center justify-content-center">
                    <div class="row g-3 w-100">
                        <div class="col-7">
                            <img src="{{ asset('assets/profile/banner_profil_1.png')}}" alt="New Arrival 1" class="new-arrivals-img h-100" style="min-height: 250px;">
                        </div>
                        <div class="col-5 d-flex flex-column gap-3">
                            <img src="{{ asset('assets/profile/banner_profil_2.png')}}" alt="New Arrival 2" class="new-arrivals-img h-50">
                            <img src="{{ asset('assets/profile/banner_profil_3.png')}}" alt="New Arrival 3" class="new-arrivals-img h-50">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Info Section (Right) -->
            <div class="col-lg-7 col-xl-6">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03) !important;">
                    <div class="card-body p-4 p-md-5 d-flex flex-column">
                        
                        <!-- Header Profile -->
                        <div class="d-flex flex-column flex-sm-row align-items-center text-center text-sm-start mb-4 gap-4">
                            <div class="position-relative">
                                <img src="{{ $user->foto_profile ? asset('storage/assets/profile/' . $user->foto_profile) : asset('assets/icon/profile_icon.png')}}" 
                                     alt="Profile Picture" 
                                     class="rounded-circle shadow-sm" 
                                     style="width: 110px; height: 110px; object-fit: cover; border: 4px solid #fff;">
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-1 text-dark">{{ $user->name }}</h4>
                                <p class="text-muted mb-1 small"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</p>
                                <p class="text-muted mb-3 small"><i class="bi bi-telephone me-2"></i>{{ $user->no_hp }}</p>
                                
                                <div class="d-flex justify-content-center justify-content-sm-start gap-2">
                                    <a href="{{route('user.edit-profile', Auth::user()->id)}}" class="btn btn-outline-primary btn-sm px-4 rounded-pill fw-medium">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                    <a href="{{route('logout')}}" class="btn btn-outline-danger btn-sm px-4 rounded-pill fw-medium">
                                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                    </a>
                                </div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-25 mb-4">

                        <!-- Detail Information -->
                        <div class="mb-4">
                            <p class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">
                                <i class="bi bi-geo-alt-fill me-1"></i> Alamat Pengiriman
                            </p>
                            <div class="bg-light p-3 rounded-3 border border-light shadow-sm">
                                <p class="mb-0 text-dark" style="font-size: 0.95rem; line-height: 1.5;">{{ $user->alamat ?: 'Belum ada alamat yang ditambahkan.' }}</p>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <!-- Action Menus -->
                            <p class="text-uppercase text-muted fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">
                                <i class="bi bi-grid-fill me-1"></i> Aktivitas Akun
                            </p>
                            <div class="list-group list-group-flush border rounded-3 overflow-hidden shadow-sm">
                                <a href="{{ route('user.keranjang', Auth::user()->id)}}" class="list-group-item list-group-item-action d-flex align-items-center py-3 custom-list-item border-bottom">
                                    <div class="bg-primary bg-opacity-10 rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                        <img src="{{asset('assets/icon/transaksi_icon.png')}}" alt="Cart" style="max-width: 22px;">
                                    </div>
                                    <span class="fw-semibold text-dark">Detail Transaksi</span>
                                    <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                                </a>
                                <a href="{{ route('user.pesanan', Auth::user()->id)}}" class="list-group-item list-group-item-action d-flex align-items-center py-3 custom-list-item">
                                    <div class="bg-info bg-opacity-10 rounded p-2 me-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                        <img src="{{asset('assets/icon/map_icon.png')}}" alt="Map" style="max-width: 22px;">
                                    </div>
                                    <span class="fw-semibold text-dark">Status Pesanan</span>
                                    <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>