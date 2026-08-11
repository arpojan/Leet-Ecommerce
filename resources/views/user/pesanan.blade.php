@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="section-title text-start mb-4">Status Pesanan</h2>

            @if($stores->isEmpty())
                <div class="card shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-body text-center py-5">
                        <h5 class="text-muted mb-3">Kamu belum memiliki pesanan</h5>
                        <a href="{{ route('home') }}" class="btn btn-primary px-4 fw-bold">Mulai Belanja</a>
                    </div>
                </div>
            @else
                <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="py-3 px-4">Info Produk</th>
                                    <th scope="col" class="py-3">Harga & Jumlah</th>
                                    <th scope="col" class="py-3">Metode Bayar</th>
                                    <th scope="col" class="py-3">Status Pembayaran</th>
                                    <th scope="col" class="py-3">Status Pesanan</th>
                                    <th scope="col" class="py-3 text-end px-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/assets/produk/' . $store->gambar0) }}" alt="{{ $store->nama_produk }}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark">{{ $store->nama_produk }}</h6>
                                                <p class="mb-0 text-muted small">{{ $store->kategori }} | Varian: {{ $store->varian }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <p class="mb-1 fw-bold text-dark">Rp {{ number_format($store->total_harga, 0, ',', '.') }}</p>
                                        <p class="mb-0 text-muted small">Qty: {{ $store->jumlah }}</p>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-dark small">
                                            @if($store->status >= 1)
                                                {{ $store->metode_pembayaran ?? 'Belum dipilih' }}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        @if($store->status == 1 && $store->pesan == 0)
                                            <span class="badge bg-danger">Pembayaran Ditolak</span>
                                        @elseif ($store->status == 1)
                                            <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                        @elseif ($store->status == 2)
                                            <span class="badge bg-info">Sedang Diproses</span>
                                        @elseif ($store->status == 3)
                                            <span class="badge bg-success">Berhasil</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if($store->status == 1 && $store->pesan == 0)
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        @elseif ($store->pesan == 1)
                                            <span class="badge bg-warning text-dark">Menunggu Aksi</span>
                                        @elseif ($store->pesan == 3)
                                            <span class="badge bg-info">Sedang Disiapkan</span>
                                        @elseif ($store->pesan == 4)
                                            <span class="badge bg-primary">Dikirim</span>
                                        @elseif ($store->pesan == 5)
                                            <span class="badge bg-success">Sudah Sampai</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-end px-4">
                                        <div class="d-flex flex-column gap-2 align-items-end">
                                            @if($store->status == 1 && $store->pesan == 0)
                                                <a href="{{ route('user.pembayaran', $store->user_id) }}" class="btn btn-outline-primary btn-sm fw-bold">Bayar Ulang</a>
                                                <a href="{{ route('user.pesanan-delete', ['user_id' => $store->user_id, 'id' => $store->id]) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</a>
                                            @elseif ($store->pesan == 1)
                                                <a href="{{ route('user.pembayaran', $store->user_id) }}" class="btn btn-primary btn-sm fw-bold">Bayar Sekarang</a>
                                                <a href="{{ route('user.pesanan-delete', ['user_id' => $store->user_id, 'id' => $store->id]) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin membatalkan pesanan ini?')">Batalkan</a>
                                            @else
                                                {{-- Jika pesanan sudah diproses/dikirim, tidak ada aksi batal --}}
                                                <span class="text-muted small">Tidak ada aksi</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection