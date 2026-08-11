<footer class="site-footer">
    <div class="container">
        <div class="row g-4 pb-3">

            {{-- Brand --}}
            <div class="col-12 col-md-4">
                <img src="{{ asset('assets/logo/leet_navbar.png')}}" alt="Leet" height="44" class="mb-3" style="border-radius:8px;">
                <p style="font-size:0.875rem; color:#aaa; line-height:1.7;">
                    Brand clothing Indonesia yang mengedepankan gaya, kenyamanan, dan kreativitas. Desain fresh &amp; edgy untuk semua kesempatan.
                </p>
            </div>

            {{-- Kolom Links --}}
            <div class="col-6 col-md-2 offset-md-1">
                <h5>Toko</h5>
                <ul class="list-unstyled">
                    <li><a href="#lokasi">Lokasi Toko</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="https://web.whatsapp.com/">Hubungi Kami</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2">
                <h5>Produk</h5>
                <ul class="list-unstyled">
                    @if(Auth::check())
                        <li><a href="{{ route('user.produk', Auth::user()->id)}}">Semua Produk</a></li>
                        <li><a href="{{ route('user.produk', Auth::user()->id)}}">Kaos</a></li>
                        <li><a href="{{ route('user.produk', Auth::user()->id)}}">Hoodie</a></li>
                        <li><a href="{{ route('user.produk', Auth::user()->id)}}">Jacket</a></li>
                    @else
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#signIn">Semua Produk</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#signIn">Kaos</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#signIn">Hoodie</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#signIn">Jacket</a></li>
                    @endif
                </ul>
            </div>

            <div class="col-12 col-md-3">
                <h5>Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="https://web.whatsapp.com">
                            📞 0812-9599-9153
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            ✉️ leetofficialstore@gmail.com
                        </a>
                    </li>
                </ul>
                <div class="d-flex gap-2 mt-2">
                    <a href="#" style="color:#aaa; font-size:1.2rem;" title="Instagram">📸</a>
                    <a href="#" style="color:#aaa; font-size:1.2rem;" title="WhatsApp">💬</a>
                    <a href="#" style="color:#aaa; font-size:1.2rem;" title="TikTok">🎵</a>
                </div>
            </div>
        </div>

        <hr class="footer-divider">
        <p class="footer-bottom">© {{ date('Y') }} LEET Official Store. All rights reserved.</p>
    </div>
</footer>