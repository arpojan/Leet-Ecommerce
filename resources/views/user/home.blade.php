@extends('layouts.app')

@section('content')

{{-- ========================= BANNER / CAROUSEL ========================= --}}
<section id="beranda">
    <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/gambar/banner_1.png')}}" class="d-block w-100" alt="Banner 1 - New Collection">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/gambar/banner_2.png')}}" class="d-block w-100" alt="Banner 2 - Free Shipping">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

{{-- ========================= PRODUCT SECTION ========================= --}}
<section class="product-section">
    <div class="container">
        <h2 class="section-title">Produk Kami</h2>
        <div class="section-divider"></div>
        <p class="section-subtitle">Koleksi terpilih dengan kualitas terbaik untuk tampilan sehari-hari kamu</p>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($produks as $produk)
                <div class="col">
                    <div class="card h-100">
                        <div style="overflow:hidden;">
                            <img src="{{ asset('storage/assets/produk/' . $produk->gambar0) }}"
                                 alt="{{ $produk->nama_produk }}"
                                 class="card-img-top"
                                 onerror="this.src='{{ asset('assets/gambar/default.png') }}'">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <span class="badge mb-2" style="background-color:#f0e9d6; color:#8a6c1a; font-size:0.72rem; width:fit-content;">{{ $produk->kategori }}</span>
                            <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                            <p class="card-price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <p class="card-text-desc">{{ $produk->deskripsi }}</p>
                            <div class="mt-auto">
                                @if(Auth::check())
                                    <a href="{{ route('user.detail-produk', ['user_id' => $user->id, 'produk_id' => $produk->id]) }}" class="btn-lihat-produk">
                                        Lihat Produk
                                    </a>
                                @else
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#signIn" class="btn-lihat-produk">
                                        Lihat Produk
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========================= ABOUT SECTION ========================= --}}
<section id="about" class="container">
    <div class="about-card">
        <div class="row align-items-center g-4">
            <div class="col-md-3 text-center">
                <div class="about-icon-wrap">
                    <img src="{{ asset('assets/logo/leet_logo.png') }}" alt="Leet Logo" class="about-logo">
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="section-title text-md-start">Hi, LEET di sini 👋</h2>
                <div class="section-divider" style="margin-left:0;"></div>
                <p class="about-text">
                    Leet adalah brand clothing Indonesia yang mengedepankan gaya, kenyamanan, dan kreativitas.
                    Dengan desain <em>fresh</em> dan <em>edgy</em>, Leet menawarkan koleksi pakaian berkualitas tinggi untuk
                    berbagai kesempatan. Kami menggunakan bahan ramah lingkungan dan proses produksi yang etis.
                    Temukan gaya unik kamu bersama Leet!
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ========================= LOKASI SECTION ========================= --}}
<section id="lokasi">
    <div class="container">
        <h2 class="section-title title-lokasi">Lokasi Kami</h2>
        <div class="section-divider"></div>
        <p class="section-subtitle">Kunjungi toko kami langsung untuk pengalaman belanja terbaik</p>

        <div class="row g-4 mb-4 align-items-center">
            <div class="col-md-8">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9457172179826!2d107.6138257!3d-6.9775158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9afc17114a3%3A0x686008ce0f77ae5d!2sJl.%20Sukabirus%20No.85%2C%20RT.2%2FRW.15%2C%20Citeureup%2C%20Kec.%20Dayeuhkolot%2C%20Kabupaten%20Bandung%2C%20Jawa%20Barat%2040257!5e0!3m2!1sen!2sid!4v1690213690179!5m2!1sen!2sid"
                        width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="lokasi-info ps-md-3">
                    <h2>📍 Bandung</h2>
                    <p>
                        Jl. Sukabirus Gang Kotaku No.85,<br>
                        RT/RW.001/015, Citeureup,<br>
                        Dayeuhkolot, Kabupaten Bandung,<br>
                        Jawa Barat 40257
                    </p>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-md-8">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4589784231557!2d106.8381655!3d-6.2926556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f20c98143f8f%3A0x9fe41ed9333f6972!2sJl.%20Bambu%20Suling%20III%20Blok%20B%20No.5%2C%20RT.4%2FRW.6%2C%20Ps.%20Minggu%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012520!5e0!3m2!1sen!2sid!4v1690213690179!5m2!1sen!2sid"
                        width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="lokasi-info ps-md-3">
                    <h2>📍 Jakarta</h2>
                    <p>
                        Jl. Bambu Suling III Blok B No.5,<br>
                        RT/RW.005/006, Pasar Minggu,<br>
                        Jakarta Selatan, 12520
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection