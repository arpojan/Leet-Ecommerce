@extends('layouts.admin')

@section('page-title', 'Manajemen Produk')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Daftar Produk</h5>
        <a href="{{ route('admin.tambah-produk') }}" class="btn btn-primary btn-sm px-3 rounded-pill fw-medium">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="ps-4">Info Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Total Stok</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/assets/produk/' . $produk->gambar0) }}" alt="{{ $produk->nama_produk }}" class="rounded shadow-sm me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ $produk->nama_produk }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1 rounded-pill text-uppercase" style="font-size: 0.75rem;">
                                {{ $produk->kategori }}
                            </span>
                        </td>
                        <td class="fw-medium text-dark">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $totalStok = $produk->stokS + $produk->stokM + $produk->stokL + $produk->stokXL + $produk->stok2XL;
                            @endphp
                            @if($totalStok > 10)
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill">{{ $totalStok }} Item</span>
                            @elseif($totalStok > 0)
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-2 py-1 rounded-pill">{{ $totalStok }} Item</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1 rounded-pill">Habis</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.edit-produk', $produk->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('admin.delete-produk', $produk->id) }}" class="btn btn-sm btn-outline-danger rounded-circle ms-1" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-inbox fs-1 mb-2"></i>
                                <p class="mb-0">Belum ada produk yang ditambahkan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
