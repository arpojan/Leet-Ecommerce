@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="section-title mb-0" style="text-align: left;">Keranjang Belanja</h2>
    </div>
    
    <div class="row g-4">
        <!-- List Produk -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body p-4" id="keranjang-container">
                    <div class="d-flex justify-content-center align-items-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Belanja -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0" style="border-radius: 12px; position: sticky; top: 100px;">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">Ringkasan Belanja</h5>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Total Harga</span>
                        <span class="fw-bold fs-5 text-dark">Rp <span id="totalHarga">0</span></span>
                    </div>

                    <hr class="my-4">
                    
                    <button id="btnBayar" class="btn btn-primary w-100 py-3 fw-bold" style="border-radius: 8px;">
                        Lanjutkan ke Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- jQuery for AJAX --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // FIX: Gunakan variabel PHP $user_id dari Blade, bukan hardcode
    const userId = {{ $user_id }};
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID', {
            style: 'decimal',
            minimumFractionDigits: 0,
        }).format(num);
    }

    function loadKeranjang() {
        $.get(`/api/user/${userId}/keranjang`, function (data) {
            const container = $('#keranjang-container');
            container.empty();

            if(data.length === 0) {
                container.append(`
                    <div class="text-center py-5">
                        <h5 class="text-muted mb-3">Keranjang belanjamu kosong</h5>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary px-4">Mulai Belanja</a>
                    </div>
                `);
                return;
            }

            data.forEach((item) => {
                container.append(`
                    <div class="d-flex align-items-center py-3 border-bottom keranjang-item">
                        <div class="form-check me-3">
                            <input class="form-check-input produk-check" type="checkbox" value="" data-id="${item.id}" data-harga="${item.total_harga}" style="width:1.2rem; height:1.2rem; cursor:pointer;" checked>
                        </div>
                        <img src="${item.gambar0}" alt="${item.nama_produk}" class="rounded" style="width: 90px; height: 90px; object-fit: cover;">
                        
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-1 fw-bold text-dark">${item.nama_produk}</h6>
                            <p class="mb-1 text-muted small">Kategori: ${item.kategori} | Varian: ${item.varian}</p>
                            <p class="mb-0 fw-bold" style="color: var(--accent);">Rp ${formatNumber(item.total_harga / item.jumlah)} <span class="text-muted fw-normal">x ${item.jumlah}</span></p>
                        </div>
                        
                        <div class="text-end">
                            <p class="mb-0 fw-bold fs-6">Rp ${formatNumber(item.total_harga)}</p>
                        </div>
                    </div>
                `);
            });

            // Update border-bottom for last item
            $('.keranjang-item').last().removeClass('border-bottom').removeClass('py-3').addClass('pt-3');
            $('.keranjang-item').first().removeClass('py-3').addClass('pb-3');

            calculateTotal();

            // Bind change event on checkboxes
            $('.produk-check').on('change', calculateTotal);
        }).fail(function() {
            $('#keranjang-container').html('<div class="text-center py-5 text-danger">Gagal memuat keranjang.</div>');
        });
    }

    function calculateTotal() {
        let totalHarga = 0;
        $('.produk-check:checked').each(function () {
            totalHarga += parseInt($(this).data('harga'));
        });
        $('#totalHarga').text(formatNumber(totalHarga));
    }

    $(document).ready(function () {
        loadKeranjang();

        $('#btnBayar').on('click', function () {
            const selectedProducts = [];
            $('.produk-check:checked').each(function () {
                selectedProducts.push($(this).data('id'));
            });

            if (selectedProducts.length === 0) {
                Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Pilih setidaknya satu produk untuk dibayar.' });
                return;
            }

            // Disable button while processing
            const btn = $(this);
            const originalText = btn.text();
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');

            $.post('/checkout', { produk: selectedProducts })
            .done(function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Checkout berhasil, beralih ke pembayaran...',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = `/user/home/${userId}/pembayaran`;
                });
            })
            .fail(function (error) {
                Swal.fire({ icon: 'error', title: 'Error', text: error.responseJSON?.message || 'Terjadi kesalahan saat checkout!' });
                btn.prop('disabled', false).text(originalText);
            });
        });
    });
</script>
@endsection