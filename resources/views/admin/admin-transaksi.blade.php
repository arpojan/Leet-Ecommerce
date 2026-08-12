@extends('layouts.admin')

@section('page-title', 'Manajemen Transaksi')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Daftar Transaksi Pesanan</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="ps-4">Info Produk</th>
                        <th>Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stores as $index => $store)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/assets/produk/' . $store->gambar0) }}" alt="{{ $store->nama_produk }}" class="rounded shadow-sm me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $store->nama_produk }}</h6>
                                        <small class="text-muted d-block">
                                            Varian: <strong>{{ $store->varian }}</strong> | Jumlah: <strong>{{ $store->jumlah }}</strong>
                                        </small>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-0 rounded-pill" style="font-size: 0.7rem;">
                                            {{ $store->kategori }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">Rp. {{ number_format($store->total_harga, 0, ',', '.') }}</div>
                                <small class="text-muted">
                                    @if($store->status == 1 && $store->pesan == 0)
                                        {{ $store->metode_pembayaran }}
                                    @elseif ($store->status == 2)
                                        {{ $store->metode_pembayaran }}
                                    @elseif ($store->status == 3)
                                        {{ $store->metode_pembayaran }}
                                    @else
                                        -
                                    @endif
                                </small>
                            </td>
                            <td>
                                @if(in_array($store->status, [1, 2, 3]) && ($store->status != 1 || $store->pesan == 0))
                                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill lihat-bukti-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#buktiPembayaranModal" 
                                        data-gambar="{{ asset('storage/assets/bukti_pembayaran/' . $store->bukti_pembayaran) }}">
                                        <i class="bi bi-receipt me-1"></i> Lihat Bukti
                                    </button>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($store->pesan == 1)
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1 rounded-pill">Belum Dibayar</span>
                                @elseif ($store->pesan == 2)
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill">Menunggu Konfirmasi</span>
                                @elseif ($store->pesan == 3)
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1 rounded-pill">Sedang Disiapkan</span>
                                @elseif ($store->pesan == 4)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 rounded-pill">Dikirim</span>
                                @elseif ($store->pesan == 5)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                @if($store->status == 2 || $store->status == 3)
                                    <a href="{{ route('admin.transaksi-detail', ['id' => $store->id]) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                        Proses <i class="bi bi-arrow-right-short"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-cart-x fs-1 mb-2"></i>
                                    <p class="mb-0">Belum ada transaksi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Bukti Pembayaran -->
<div class="modal fade" id="buktiPembayaranModal" tabindex="-1" aria-labelledby="buktiPembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0">
                <h6 class="modal-title fw-bold" id="buktiPembayaranModalLabel">Bukti Pembayaran</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0 bg-light">
                <img src="" id="buktiPembayaranImg" alt="Bukti Pembayaran" class="img-fluid w-100" style="max-height: 70vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.lihat-bukti-btn').forEach(button => {
            button.addEventListener('click', function () {
                const gambar = this.getAttribute('data-gambar');
                document.getElementById('buktiPembayaranImg').setAttribute('src', gambar);
            });
        });
    });
</script>
@endsection