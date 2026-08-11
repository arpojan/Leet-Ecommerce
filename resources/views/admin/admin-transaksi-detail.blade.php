<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LEET</title>
    <link rel="icon" href="{{ asset('assets/logo/logo_leet.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    
        textarea[readonly] {
            border: 1px solid #dee2e6;
            resize: none;
            text-align: left !important; /* Mengatur teks textarea ke kiri */
            white-space: pre-line; /* Menjaga format teks */

        }
    
        .modal-content {
            border-radius: 10px;
        }
    
        .modal-header {
            padding: 10px 10px;
            background-color: #f0f0f0;
        }
        .modal-footer {
            padding: 10px 10px;
            background-color: #f0f0f0;
        }
    
        .modal-title {
            font-weight: bold;
        }
    
        .text-danger {
            color: #dc3545 !important;
            font-weight: bold;
        }
    
        img.img-thumbnail {
            object-fit: cover;
        }
    
        /* Custom Styling */
        .modal-body .row {
            margin: 0;
        }
    
        .modal-body .col-md-7 {
            padding: 20px 25px; /* Tambahkan padding di sekitar form */
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    
        .modal-body .col-md-7 .form-label {
            font-weight: bold;
        }
    
        .modal-body .col-md-7 .form-control {
            border: 1px solid #dee2e6;
            box-shadow: none;
        }
    
        .modal-body .col-md-5 {
            text-align: center; /* Agar gambar dan teks terpusat */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f9f9f9;
            border-left: 2px solid #e9ecef;
            padding: 20px;
            border-radius: 8px;
        }
    
        .modal-body .col-md-5 img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
            max-height: 200px; /* Batasi tinggi gambar */
        }
    
        .modal-body .col-md-5 p {
            margin: 0;
            font-size: 16px;
        }
    
        .modal-body .col-md-5 h4 {
            color: #343a40;
            font-weight: bold;
        }

        .card {
            border-radius: 10px;
            background-color: #ffffff;
        }

        .card-body {
            text-align: left; /* Mengatur teks dalam card menjadi rata kiri */
        }

        .card img {
            max-height: 150px;
            object-fit: cover;
        }

    </style>
</head>
<body>
    <div class="container mt-3 mb-3">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.transaksi-proses', ['id' => $store->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                        <!-- Left Section -->
                            <div class="col-md-7">
                                    <div class="mb-3">
                                        <label for="nama-pembeli" class="form-label">Nama Pembeli</label>
                                        <input type="text" id="nama-pembeli" class="form-control" value="{{ $user['name'] }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">Telepon</label>
                                        <input type="text" id="telepon" class="form-control" value="{{ $user['no_hp']}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea id="alamat" class="form-control" rows="3" readonly>
                                            {{ $user['alamat'] }}
                                        </textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="metode-pembayaran" class="form-label">Metode Pembayaran</label>
                                        <input type="text" id="metode-pembayaran" class="form-control" value="{{ $store['metode_pembayaran'] }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bukti-pembayaran" class="form-label">Bukti Pembayaran</label>
                                        <div class="d-flex align-items-center">
                                            @if ($store->status == 1 && $store->pesan == 0)
                                                <button type="button" class="btn btn-primary lihat-bukti-btn" 
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
                                                    Lihat
                                                </button>
                                            @elseif ($store->status == 2)
                                                <button type="button" class="btn btn-primary lihat-bukti-btn" 
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
                                                    Lihat
                                                </button>
                                            @elseif ($store->status == 3)
                                                <button type="button" class="btn btn-primary lihat-bukti-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#buktiPembayaranModal" 
                                                    id-transaksi="{{ $store->id }}"
                                                    data-pembeli="{{ $store->user_id }}"
                                                    data-produk="{{ $store->produk_id }}"
                                                    data-jumlah="{{ $store->jumlah }}"
                                                    data-varian="{{ $store->varian }}"
                                                    data-status="{{ $store->status }}"
                                                    data-pesan="{{ $store->pesan }}"
                                                    data-gambar="{{ asset('storage/assets/bukti_pembayaran/' . $store->bukti_pembayaran) }}"
                                                    >
                                                    Lihat
                                                </button>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status-pembayaran" class="form-label">Status Pembayaran</label>
                                            @if($store['status'] == 1) 
                                                <span id="status-pembayaran" class="form-control badge bg-danger">Pembayaran Ditolak</span> 
                                            @elseif($store['status'] == 2)
                                                <span id="status-pembayaran" class="form-control badge bg-warning text-dark">Menunggu Konfirmasi</span> 
                                            @elseif($store['status'] == 3)
                                                <span id="status-pembayaran" class="form-control badge bg-success">Pembayaran Berhasil</span>
                                            @else
                                                <span id="status-pembayaran" class="form-control badge bg-danger">-</span>
                                            @endif 
                                    </div>
                                    <div class="mb-3">
                                        <label for="status-pesanan" class="form-label">Status Pesanan</label>
                                        @if($store['status'] == 1)
                                            <input type="text" id="status-pesanan" class="form-control" value="-" readonly>
                                        @elseif($store['status'] == 2)
                                            <input type="text" id="status-pesanan" class="form-control" value="-" readonly>
                                        @else
                                            <select id="status-pesanan" class="form-select" name="pesan">
                                                <option value="3" @if($store['pesan'] == 3) selected @endif>Preparing Order</option>
                                                <option value="4" @if($store['pesan'] == 4) selected @endif>Pesanan Dikirim</option>
                                                <option value="5" @if($store['pesan'] == 5) selected @endif>Pesanan Sudah Sampai Tujuan</option>
                                            </select>
                                        @endif        
                                    </div>
                                </div>
                                <!-- Right Section -->
                                <div class="col-md-5">
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/assets/produk/' . $store['gambar0']) }}" 
                                            alt="{{ $store['nama_produk'] }}"  
                                            style="max-width: 150px;">
                                            <h4 class="fw-bold">{{ $store['nama_produk'] }}</h4>
                                            <p>Jumlah: {{$store['jumlah']}}</p>
                                            <p>Varian: {{ $store['varian'] }}</p>
                                            <h6 class="text-dark">Harga: Rp{{ number_format($store['total_harga'], 0, ',', '.') }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="buktiPembayaranModal" tabindex="-1" aria-labelledby="buktiPembayaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buktiPembayaranModalLabel">Bukti Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="buktiPembayaranImg" alt="Bukti Pembayaran" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <form id="transaksiForm" method="POST" data-route="{{ route('admin.transaksi-sukses', ['id' => 'transaksi_id']) }}">
                        @csrf
                        <input type="hidden" name="id" id="idTransaksi">
                        <input type="hidden" name="user_id" id="pembeli">
                        <input type="hidden" name="produk_id" id="produk">
                        <input type="hidden" name="jumlah" id="jumlah">
                        <input type="hidden" name="varian" id="varian">
                        <input type="hidden" name="status" id="status">
                        <input type="hidden" name="pesan" id="pesan">
                        <button type="submit" class="btn btn-primary" @if($store['status'] == 3) disabled @endif>Terima Pembayaran</button>
                    </form>
                    <form id="transaksiFormGagal" method="POST" data-routeGagal="{{ route('admin.transaksi-gagal', ['id' => 'transaksi_idGagal']) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger" @if($store['status'] == 3) disabled @endif>Tolak Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.lihat-bukti-btn').forEach(button => {
            button.addEventListener('click', function () {
                // Ambil atribut data dari tombol
                const idTransaksi = this.getAttribute('id-transaksi');
                const pembeli = this.getAttribute('data-pembeli');
                const produk = this.getAttribute('data-produk');
                const jumlah = this.getAttribute('data-jumlah');
                const varian = this.getAttribute('data-varian');
                const status = this.getAttribute('data-status');
                const pesan = this.getAttribute('data-pesan');
                const gambar = this.getAttribute('data-gambar');

                // Set nilai ke form
                document.getElementById('idTransaksi').value = idTransaksi;
                document.getElementById('pembeli').value = pembeli;
                document.getElementById('produk').value = produk;
                document.getElementById('jumlah').value = jumlah;
                document.getElementById('varian').value = varian;
                document.getElementById('status').value = status;
                document.getElementById('pesan').value = pesan;

                // Tampilkan gambar bukti pembayaran
                document.getElementById('buktiPembayaranImg').setAttribute('src', gambar);

                // Perbarui route form sukses
                const form = document.getElementById('transaksiForm');
                const routeTemplate = form.getAttribute('data-route');
                const updatedRoute = routeTemplate.replace('transaksi_id', idTransaksi);
                form.setAttribute('action', updatedRoute);

                // Perbarui route form gagal
                const formGagal = document.getElementById('transaksiFormGagal');
                const routeTemplateGagal = formGagal.getAttribute('data-routeGagal');
                const updatedRouteGagal = routeTemplateGagal.replace('transaksi_idGagal', idTransaksi);
                formGagal.setAttribute('action', updatedRouteGagal);
            });
        });
    </script>
</body>
</html>