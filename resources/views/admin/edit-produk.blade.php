@extends('layouts.admin')

@section('page-title', 'Edit Produk')

@section('content')
<div class="row">
    <div class="col-12 col-xl-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="m-0 fw-bold">Ubah Informasi Produk</h5>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.update-produk', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="namaProduk" class="form-label fw-semibold">Nama Produk</label>
                            <input type="text" class="form-control" id="namaProduk" name="namaProduk" value="{{ $produk->nama_produk }}">
                            @error('namaProduk')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="kategori" class="form-label fw-semibold">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $produk->kategori }}">
                            @error('kategori')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi Lengkap</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ $produk->deskripsi }}</textarea>
                        @error('deskripsi')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-semibold mb-3">Foto Produk</label>
                        <div class="row g-3">
                            @for ($i = 0; $i <= 3; $i++)
                                <div class="col-6 col-md-3">
                                    <div class="position-relative border rounded-3 p-2 text-center" style="background-color: #f8f9fa;">
                                        <div class="mb-2 overflow-hidden rounded d-flex align-items-center justify-content-center" style="height: 120px; background-color: #fff;">
                                            <img id="selectedImage{{ $i }}" 
                                                 src="{{ $produk->{'gambar' . $i} ? asset('storage/assets/produk/' . $produk->{'gambar' . $i}) : asset('assets/icon/upload-placeholder.png') }}" 
                                                 onerror="this.src='https://placehold.co/150x150?text=Upload+Foto'" 
                                                 alt="gambar {{ $i }}" 
                                                 style="max-height: 100%; max-width: 100%; object-fit: contain;" />
                                        </div>
                                        <div class="d-grid">
                                            <label class="btn btn-sm btn-outline-primary" for="customFile{{ $i }}">
                                                Pilih File
                                            </label>
                                            <input type="file" class="d-none" id="customFile{{ $i }}" name="gambar[]" onchange="displaySelectedImage(event, 'selectedImage{{ $i }}')" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        @error('gambar')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="text-muted opacity-25 my-4">

                    <div class="row g-4 mb-4">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold mb-3">Varian & Stok</label>
                            <div id="varian-container-edit">
                                @foreach ($varian as $size => $stok)
                                    <div class="d-flex gap-2 mb-2 varian-item-edit">
                                        <select class="form-select w-50" name="varian[{{ $size }}]">
                                            <option disabled>Pilih Varian</option>
                                            <option value="S" {{ $size == 'S' ? 'selected' : '' }}>Ukuran S</option>
                                            <option value="M" {{ $size == 'M' ? 'selected' : '' }}>Ukuran M</option>
                                            <option value="L" {{ $size == 'L' ? 'selected' : '' }}>Ukuran L</option>
                                            <option value="XL" {{ $size == 'XL' ? 'selected' : '' }}>Ukuran XL</option>
                                            <option value="2XL" {{ $size == '2XL' ? 'selected' : '' }}>Ukuran 2XL</option>
                                        </select>
                                        <input type="number" class="form-control" name="stok[{{ $size }}]" placeholder="Jumlah Stok" value="{{ $stok }}" min="0">
                                        <button type="button" class="btn btn-outline-danger hapus-varian-edit" title="Hapus Varian">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                                <button type="button" class="btn btn-outline-primary mt-2 btn-sm" id="tambah-varian-edit">
                                    <i class="bi bi-plus-lg me-1"></i> Tambah Varian
                                </button>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" class="form-control fs-5" id="harga" name="harga" value="{{ $produk->harga }}" min="0">
                            </div>
                            @error('harga')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5">
                        <a href="{{ route('admin') }}" class="btn btn-light px-4 border">Batal</a>
                        <button type="submit" class="btn btn-success px-4"><i class="bi bi-check2-circle me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function displaySelectedImage(event, elementId) {
        const selectedImage = document.getElementById(elementId);
        const fileInput = event.target;

        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                selectedImage.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
@endsection