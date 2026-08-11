@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="section-title text-start mb-4">Pembayaran</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.pembayaran-proses', ['user_id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Data Pengiriman --}}
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Informasi Pengiriman</h5>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">Nama Lengkap</label>
                                <p class="fw-bold mb-2">{{ $user['name'] }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small mb-1">Nomor Telepon</label>
                                <p class="fw-bold mb-2">{{ $user['no_hp'] }}</p>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-muted small mb-1">Alamat Pengiriman</label>
                                <p class="fw-bold mb-0">{{ $user['alamat'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Rincian Produk --}}
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Pesanan Anda</h5>
                        
                        <div class="product-list">
                            @foreach ($store as $item)
                            <div class="d-flex align-items-center py-3 border-bottom keranjang-item">
                                <img src="{{ $item->gambar0 }}" alt="Produk" class="rounded" style="width: 70px; height: 70px; object-fit: cover;">
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-1 fw-bold">{{ $item->nama_produk }}</h6>
                                    <p class="mb-1 text-muted small">Varian: {{ $item->varian }}</p>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0 text-muted small">{{ $item->jumlah }} x Rp {{ number_format($item->total_harga / $item->jumlah, 0, ',', '.') }}</p>
                                    <p class="mb-0 fw-bold harga-produk" data-harga="{{ $item->total_harga }}">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Metode Pembayaran & Rincian Harga --}}
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 border-bottom pb-2">Rincian Pembayaran</h5>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="metode_pembayaran" class="form-label fw-bold small">Pilih Metode Pembayaran <span class="text-danger">*</span></label>
                                    <select class="form-select bg-light" name="metode_pembayaran" id="metode_pembayaran" required>
                                        <option value="" disabled selected>Pilih salah satu...</option>
                                        <option value="Transfer Bank BCA">Transfer Bank BCA - 57658764 a.n Leet Store</option>
                                        <option value="Transfer Bank Mandiri">Transfer Bank Mandiri - 1300054321 a.n Leet Store</option>
                                        <option value="E-Wallet Gopay">Gopay / OVO - 0812-9599-9153</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label fw-bold small">Upload Bukti Transfer <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/png, image/jpeg, image/jpg" required>
                                    <div class="form-text small">Format JPG, JPEG, PNG (Maks 2MB)</div>
                                </div>
                            </div>
                            <div class="col-md-6 border-start ps-md-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Subtotal Produk</span>
                                    <span class="fw-bold small" id="text_sub_total">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                                    <span class="text-muted small">Ongkos Kirim</span>
                                    <span class="fw-bold small" id="text_ongkir" data-ongkir="{{ $ongkir }}">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold fs-6">Total Belanja</span>
                                    <span class="fw-bold fs-4" style="color: var(--accent);" id="text_total_harga">Rp 0</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="d-flex justify-content-end mb-5">
                    <a href="{{ route('user.keranjang', $user->id) }}" class="btn btn-light me-3 px-4 fw-bold">Kembali</a>
                    <button type="submit" class="btn btn-primary px-5 fw-bold" id="btnSubmit">Bayar Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form');
        const btnSubmit = document.getElementById('btnSubmit');

        form.addEventListener('submit', (e) => {
            const metodeBayar = document.getElementById('metode_pembayaran');
            const buktiBayar = document.getElementById('bukti_pembayaran');

            if (!metodeBayar.value || !buktiBayar.files.length) {
                e.preventDefault();
                Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Mohon lengkapi metode dan bukti pembayaran!' });
                return;
            }

            // Disable button to prevent double submit
            btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...';
            btnSubmit.classList.add('disabled');
        });

        // Hitung total harga
        const produkCards = document.querySelectorAll('.harga-produk');
        let subTotal = 0;

        produkCards.forEach(card => {
            subTotal += parseInt(card.dataset.harga, 10);
        });

        const ongkir = parseInt(document.getElementById('text_ongkir').dataset.ongkir, 10);
        const totalHarga = subTotal + ongkir;

        const formatNumber = (num) => new Intl.NumberFormat('id-ID').format(num);

        document.getElementById('text_sub_total').textContent = 'Rp ' + formatNumber(subTotal);
        document.getElementById('text_total_harga').textContent = 'Rp ' + formatNumber(totalHarga);
        
        // Hapus border bawah pada item terakhir
        const items = document.querySelectorAll('.keranjang-item');
        if(items.length > 0) {
            items[items.length - 1].classList.remove('border-bottom');
        }
    });
</script>
@endsection