@extends('layouts.admin')

@section('page-title', 'Detail Transaksi')

@section('content')
<div class="row">
    <div class="col-12 col-xl-10 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Order #{{ str_pad($store->id, 5, '0', STR_PAD_LEFT) }}</h4>
            <a href="{{ route('admin.transaksi') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.transaksi-proses', ['id' => $store->id]) }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <!-- Kolom Kiri: Detail Pelanggan & Pembayaran -->
                <div class="col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 fw-bold"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Informasi Pelanggan</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-4 text-muted small">Nama Pelanggan</div>
                                <div class="col-sm-8 fw-semibold">{{ $user['name'] }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 text-muted small">Nomor Telepon</div>
                                <div class="col-sm-8">{{ $user['no_hp'] }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 text-muted small">Alamat Pengiriman</div>
                                <div class="col-sm-8">
                                    <p class="mb-0 bg-light p-2 rounded small">{{ $user['alamat'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 fw-bold"><i class="bi bi-credit-card-2-front me-2 text-primary"></i>Informasi Pembayaran & Status</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-4 text-muted small">Metode Pembayaran</div>
                                <div class="col-sm-8 fw-semibold">{{ $store['metode_pembayaran'] }}</div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-sm-4 text-muted small">Status Pembayaran</div>
                                <div class="col-sm-8">
                                    @if($store['status'] == 1) 
                                        <span class="badge bg-danger">Pembayaran Ditolak</span> 
                                    @elseif($store['status'] == 2)
                                        <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span> 
                                    @elseif($store['status'] == 3)
                                        <span class="badge bg-success">Pembayaran Berhasil</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row mb-4 align-items-center">
                                <div class="col-sm-4 text-muted small">Bukti Transfer</div>
                                <div class="col-sm-8">
                                    @if(in_array($store->status, [1, 2, 3]) && ($store->status != 1 || $store->pesan == 0))
                                        <button type="button" class="btn btn-sm btn-outline-info rounded-pill lihat-bukti-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#buktiPembayaranModal" 
                                            id-transaksi="{{ $store->id }}"
                                            data-pembeli="{{ $store->user_id }}"
                                            data-produk="{{ $store->produk_id }}"
                                            data-jumlah="{{ $store->jumlah }}"
                                            data-varian="{{ $store->varian }}"
                                            data-status="{{ $store->status }}"
                                            data-pesan="{{ $store->pesan }}"
                                            data-gambar="{{ asset('storage/assets/bukti_pembayaran/' . $store->bukti_pembayaran) }}">
                                            <i class="bi bi-eye me-1"></i> Lihat Bukti
                                        </button>
                                    @else
                                        <span class="text-muted small">Belum ada bukti</span>
                                    @endif
                                </div>
                            </div>
                            
                            <hr class="text-muted opacity-25">
                            
                            <div class="row align-items-center">
                                <div class="col-sm-4 text-muted small">Update Status Pesanan</div>
                                <div class="col-sm-8">
                                    @if(in_array($store['status'], [1, 2]))
                                        <input type="text" class="form-control form-control-sm bg-light text-muted" value="Harus konfirmasi pembayaran dulu" readonly>
                                    @else
                                        <select id="status-pesanan" class="form-select form-select-sm border-primary" name="pesan">
                                            <option value="3" @if($store['pesan'] == 3) selected @endif>Sedang Disiapkan</option>
                                            <option value="4" @if($store['pesan'] == 4) selected @endif>Sedang Dikirim</option>
                                            <option value="5" @if($store['pesan'] == 5) selected @endif>Selesai (Sampai Tujuan)</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 py-3 text-end">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm" {{ in_array($store['status'], [1, 2]) ? 'disabled' : '' }}>
                                <i class="bi bi-save me-1"></i> Simpan Status
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Ringkasan Pesanan -->
                <div class="col-lg-5">
                    <div class="card bg-primary bg-gradient text-white shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h6 class="fw-normal mb-1 opacity-75">Total Tagihan</h6>
                            <h2 class="fw-bold mb-0">Rp {{ number_format($store['total_harga'], 0, ',', '.') }}</h2>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 fw-bold"><i class="bi bi-box-seam me-2 text-primary"></i>Ringkasan Produk</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-3 d-flex align-items-center border-bottom border-light">
                                <div class="bg-light rounded p-2 me-3 text-center" style="width: 80px; height: 80px;">
                                    <img src="{{ asset('storage/assets/produk/' . $store['gambar0']) }}" alt="{{ $store['nama_produk'] }}" class="img-fluid rounded" style="max-height: 100%; object-fit: contain;">
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">{{ $store['nama_produk'] }}</h6>
                                    <div class="text-muted small mb-1">
                                        Kategori: {{ $store['kategori'] ?? '-' }}
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-light text-dark border">Varian: {{ $store['varian'] }}</span>
                                        <span class="badge bg-light text-dark border">Qty: {{ $store['jumlah'] }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 bg-light bg-opacity-50">
                                <div class="d-flex justify-content-between mb-2 small text-muted">
                                    <span>Harga per item</span>
                                    <span>Rp {{ number_format($store['total_harga'] / max($store['jumlah'], 1), 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold text-dark">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($store['total_harga'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Bukti Pembayaran -->
<div class="modal fade" id="buktiPembayaranModal" tabindex="-1" aria-labelledby="buktiPembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0">
                <h6 class="modal-title fw-bold" id="buktiPembayaranModalLabel">Konfirmasi Bukti Pembayaran</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0 bg-light">
                <img src="" id="buktiPembayaranImg" alt="Bukti Pembayaran" class="img-fluid w-100" style="max-height: 50vh; object-fit: contain;">
            </div>
            <div class="modal-footer bg-white border-top-0 justify-content-center gap-3">
                <form id="transaksiForm" method="POST" data-route="{{ route('admin.transaksi-sukses', ['id' => 'transaksi_id']) }}">
                    @csrf
                    <input type="hidden" name="id" id="idTransaksi">
                    <input type="hidden" name="user_id" id="pembeli">
                    <input type="hidden" name="produk_id" id="produk">
                    <input type="hidden" name="jumlah" id="jumlah">
                    <input type="hidden" name="varian" id="varian">
                    <input type="hidden" name="status" id="status">
                    <input type="hidden" name="pesan" id="pesan">
                    <button type="submit" class="btn btn-success px-4 rounded-pill" @if($store['status'] == 3) disabled @endif>
                        <i class="bi bi-check-circle me-1"></i> Terima Pembayaran
                    </button>
                </form>
                <form id="transaksiFormGagal" method="POST" data-routeGagal="{{ route('admin.transaksi-gagal', ['id' => 'transaksi_idGagal']) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger px-4 rounded-pill" @if($store['status'] == 3) disabled @endif>
                        <i class="bi bi-x-circle me-1"></i> Tolak
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.lihat-bukti-btn').forEach(button => {
            button.addEventListener('click', function () {
                const idTransaksi = this.getAttribute('id-transaksi');
                const pembeli = this.getAttribute('data-pembeli');
                const produk = this.getAttribute('data-produk');
                const jumlah = this.getAttribute('data-jumlah');
                const varian = this.getAttribute('data-varian');
                const status = this.getAttribute('data-status');
                const pesan = this.getAttribute('data-pesan');
                const gambar = this.getAttribute('data-gambar');

                document.getElementById('idTransaksi').value = idTransaksi;
                document.getElementById('pembeli').value = pembeli;
                document.getElementById('produk').value = produk;
                document.getElementById('jumlah').value = jumlah;
                document.getElementById('varian').value = varian;
                document.getElementById('status').value = status;
                document.getElementById('pesan').value = pesan;

                document.getElementById('buktiPembayaranImg').setAttribute('src', gambar);

                const form = document.getElementById('transaksiForm');
                const routeTemplate = form.getAttribute('data-route');
                form.setAttribute('action', routeTemplate.replace('transaksi_id', idTransaksi));

                const formGagal = document.getElementById('transaksiFormGagal');
                const routeTemplateGagal = formGagal.getAttribute('data-routeGagal');
                formGagal.setAttribute('action', routeTemplateGagal.replace('transaksi_idGagal', idTransaksi));
            });
        });
    });
</script>
@endsection