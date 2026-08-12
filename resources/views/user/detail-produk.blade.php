<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEET - {{ $produk->nama_produk }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .product-image-main {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            object-fit: cover;
            background-color: #fff;
        }
        .product-thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            background-color: #fff;
        }
        .product-thumbnail:hover, .product-thumbnail.active {
            border-color: #c9a84c; /* Accent color */
        }
        .size-btn {
            width: 50px;
            height: 50px;
            margin-right: 8px;
            margin-bottom: 8px;
            text-align: center;
            border-radius: 8px;
            font-weight: 500;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #212529;
            transition: all 0.2s;
        }
        .size-btn:hover {
            border-color: #c9a84c;
            color: #c9a84c;
        }
        .size-btn.active {
            background-color: #1a1a2e; /* Primary color */
            color: #fff;
            border-color: #1a1a2e;
        }
        .add-to-cart-btn {
            background-color: #1a1a2e;
            color: #fff;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.3s;
            border: none;
        }
        .add-to-cart-btn:hover {
            background-color: #c9a84c;
            color: #fff;
            transform: translateY(-2px);
        }
        .qty-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: #fff;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .qty-btn:hover {
            background: #f1f3f5;
        }
        .qty-input {
            width: 50px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
        }
        .qty-input:focus {
            outline: none;
        }
        .qty-wrapper {
            display: inline-flex;
            align-items: center;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 2px;
        }
        .product-info-card {
            background: #fff;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            height: 100%;
        }
    </style>
</head>
<body>
    @include('layouts.app.navbar')

    <div class="container py-5">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Product Images Section -->
            <div class="col-lg-5">
                <div class="mb-3 position-relative">
                    <img id="mainImage" src="{{ asset('storage/assets/produk/' . $produk->gambar0) }}" alt="{{ $produk->nama_produk }}" class="product-image-main">
                </div>

                <div class="d-flex gap-2 justify-content-center justify-content-lg-start">
                    <img src="{{ asset('storage/assets/produk/' . $produk->gambar0) }}" alt="{{ $produk->nama_produk }}" class="product-thumbnail active" onclick="changeImage(this, '{{ asset('storage/assets/produk/' . $produk->gambar0) }}')">
                    @if($produk->gambar1)
                        <img src="{{ asset('storage/assets/produk/' . $produk->gambar1) }}" alt="{{ $produk->nama_produk }}" class="product-thumbnail" onclick="changeImage(this, '{{ asset('storage/assets/produk/' . $produk->gambar1) }}')">
                    @endif
                    @if($produk->gambar2)
                        <img src="{{ asset('storage/assets/produk/' . $produk->gambar2) }}" alt="{{ $produk->nama_produk }}" class="product-thumbnail" onclick="changeImage(this, '{{ asset('storage/assets/produk/' . $produk->gambar2) }}')">
                    @endif
                    @if($produk->gambar3)
                        <img src="{{ asset('storage/assets/produk/' . $produk->gambar3) }}" alt="{{ $produk->nama_produk }}" class="product-thumbnail" onclick="changeImage(this, '{{ asset('storage/assets/produk/' . $produk->gambar3) }}')">
                    @endif
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="col-lg-7">
                <div class="product-info-card d-flex flex-column">
                    <div>
                        <div class="badge bg-light text-dark mb-3 px-3 py-2 text-uppercase rounded-pill border">{{$produk->kategori}}</div>
                        <h2 class="fw-bold mb-2 text-dark">{{$produk->nama_produk}}</h2>
                        <h3 class="fw-bold mb-4" style="color: #c9a84c;">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</h3>
                        
                        <hr class="text-muted opacity-25 my-4">

                        <h6 class="fw-bold mb-3"><i class="bi bi-card-text me-2"></i>Detail Produk:</h6>
                        <div class="text-muted" style="line-height: 1.7;">
                            {!! nl2br(e($produk->deskripsi ?? 'Detail produk belum tersedia.')) !!}
                        </div>

                        <hr class="text-muted opacity-25 my-4">
                    </div>

                    <div class="mt-auto">
                        <div class="mb-4">
                            <label class="form-label fw-bold mb-3">Pilih Ukuran:</label>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn size-btn" {{ $produk->stokS == 0 ? 'disabled' : '' }}>S</button>
                                <button type="button" class="btn size-btn" {{ $produk->stokM == 0 ? 'disabled' : '' }}>M</button>
                                <button type="button" class="btn size-btn active" {{ $produk->stokL == 0 ? 'disabled' : '' }}>L</button>
                                <button type="button" class="btn size-btn" {{ $produk->stokXL == 0 ? 'disabled' : '' }}>XL</button>
                                <button type="button" class="btn size-btn" {{ $produk->stok2XL == 0 ? 'disabled' : '' }}>2XL</button>
                            </div>
                        </div>
                        
                        <div class="mb-4 d-flex align-items-center gap-4">
                            <div>
                                <label for="quantity" class="form-label fw-bold mb-2">Kuantitas:</label>
                                <div>
                                    <div class="qty-wrapper">
                                        <button type="button" class="qty-btn" id="btn-minus"><i class="bi bi-dash fs-5"></i></button>
                                        <input type="number" id="quantity" class="qty-input" value="1" min="1" readonly>
                                        <button type="button" class="qty-btn" id="btn-plus"><i class="bi bi-plus fs-5"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <form action="{{ route('user.detail-produk.keranjang', ['user_id' => $user_id, 'produk_id' => $produk_id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <input type="hidden" name="produk_id" value="{{ $produk_id }}">
                            <input type="hidden" name="nama_produk" value="{{ $produk->nama_produk }}">
                            <input type="hidden" name="kategori" value="{{ $produk->kategori }}">
                            <input type="hidden" name="gambar0" value="{{ $produk->gambar0 }}">
                            <input type="hidden" name="jumlah" id="form-quantity" value="1">
                            <input type="hidden" name="varian" id="form-varian" value="L"> <!-- Default variant -->
                            <input type="hidden" name="total_harga" id="form-total-harga" value="{{ $produk->harga }}" >
                            <input type="hidden" name="status" value="0">
                            
                            <button type="submit" class="btn add-to-cart-btn w-100 d-flex align-items-center justify-content-center gap-2 py-3">
                                <i class="bi bi-cart-plus fs-5"></i> Tambahkan Ke Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to change main image on thumbnail click
        function changeImage(element, src) {
            document.getElementById('mainImage').src = src;
            
            // Remove active class from all thumbnails
            document.querySelectorAll('.product-thumbnail').forEach(thumb => {
                thumb.classList.remove('active');
            });
            
            // Add active class to clicked thumbnail
            element.classList.add('active');
        }

        const quantityInput = document.getElementById('quantity');
        const formQuantityInput = document.getElementById('form-quantity');

        // Quantity increment and decrement
        document.getElementById('btn-minus').addEventListener('click', function() {
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                formQuantityInput.value = quantityInput.value; // Update hidden input
                updateTotalHarga();
            }
        });

        document.getElementById('btn-plus').addEventListener('click', function() {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            formQuantityInput.value = quantityInput.value; // Update hidden input
            updateTotalHarga();
        });

        // Size selection
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if(this.hasAttribute('disabled')) return; // Ignore disabled buttons
                
                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('form-varian').value = this.textContent; // Update hidden input
            });
        });

        const hargaProduk = {{ $produk->harga }};
        const totalHargaInput = document.getElementById('form-total-harga');

        // Fungsi untuk memperbarui total harga
        function updateTotalHarga() {
            const jumlahItem = parseInt(quantityInput.value);
            const totalHarga = hargaProduk * jumlahItem;
            totalHargaInput.value = totalHarga; // Perbarui hidden input
        }

        // Inisialisasi awal
        updateTotalHarga();
    </script>
</body>
</html>
