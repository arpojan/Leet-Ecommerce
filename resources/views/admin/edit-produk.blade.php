@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.update-produk', $produk->id) }}" method="POST" enctype="multipart/form-data" class="tambah-produk mb-5 mt-5">
        @csrf
        <div class="mb-3 row">
            <label for="namaProduk" class="col-sm-2 col-form-label">Nama Produk</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="namaProduk" name="namaProduk" value="{{ $produk->nama_produk }}">
            </div>
            @error('namaProduk')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3 row">
            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $produk->kategori }}">
            </div>
            @error('kategori')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3 row">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $produk->deskripsi }}</textarea>
            </div>
            @error('deskripsi')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label">Gambar</label>
            <div class="col-sm-10 mb-3 row gambar-wrapper">
                @for ($i = 0; $i <= 3; $i++)
                    <div>
                        <div class="mb-4 d-flex justify-content-center">
                            <img id="selectedImage{{ $i }}" src="{{ asset('storage/assets/produk/' . $produk->{'gambar' . $i}) }}" alt="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"/>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                <label class="form-label text-white m-1" for="customFile{{ $i }}">Choose file</label>
                                <input type="file" class="form-control d-none" id="customFile{{ $i }}" name="gambar[]" onchange="displaySelectedImage(event, 'selectedImage{{ $i }}')" />
                            </div>
                        </div>
                    </div>
                @endfor
                @error('gambar')
                    <small>{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="varian" class="col-sm-2 col-form-label">Varian dan Stok</label>
            <div class="col-sm-10" id="varian-container-edit">
                @foreach ($varian as $size => $stok)
                    <div class="d-flex gap-2 mb-2 varian-item-edit">
                        <select class="form-select" name="varian[{{ $size }}]" aria-label="Default select example">
                            <option selected disabled>Pilih Varian</option>
                            <option value="S" {{ $size == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ $size == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ $size == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ $size == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="2XL" {{ $size == '2XL' ? 'selected' : '' }}>2XL</option>
                        </select>
                        <input type="number" class="form-control" name="stok[{{ $size }}]" placeholder="Jumlah Stock" value="{{ $stok }}">
                        <button type="button" class="btn btn-danger hapus-varian-edit">Hapus</button>
                    </div>
                @endforeach
                <button type="button" class="btn btn-primary mt-2" id="tambah-varian-edit">Tambah Varian</button>
            </div>
        </div>
       
        <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="harga" name="harga" value={{ $produk->harga }}>
            </div>
            @error('harga')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="text-end">
            <button class="btn btn-danger"><a href="{{ route('admin') }}" class="text-white text-decoration-none">Kembali</a></button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
@endsection