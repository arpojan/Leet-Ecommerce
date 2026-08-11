<nav class="custom-navbar">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between py-2">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo text-decoration-none d-flex align-items-center">
          <img src="{{ asset('assets/logo/leet_navbar.png')}}" alt="Leet">
        </a>

        {{-- Nav Links --}}
        <ul class="nav mb-0 d-none d-md-flex align-items-center gap-1">
          @if(Auth::check())
            <li><a href="{{ route('user.home', Auth::user()->id)}}#beranda" class="nav-link">Beranda</a></li>
            <li><a href="{{ route('user.produk', Auth::user()->id)}}" class="nav-link">Produk</a></li>
            <li><a href="{{ route('user.home', Auth::user()->id)}}#about" class="nav-link">Tentang</a></li>
            <li><a href="{{ route('user.home', Auth::user()->id)}}#lokasi" class="nav-link">Lokasi</a></li>
          @else
            <li><a href="#beranda" class="nav-link">Beranda</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#signIn" class="nav-link">Produk</a></li>
            <li><a href="#about" class="nav-link">Tentang</a></li>
            <li><a href="#lokasi" class="nav-link">Lokasi</a></li>
          @endif
        </ul>

        {{-- Icons --}}
        <div class="d-flex align-items-center gap-2">
          {{-- Keranjang --}}
          @if(Auth::check())
            <a href="{{ route('user.keranjang', Auth::user()->id) }}" class="navbar-icon-btn" title="Keranjang">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h13L17 13M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
              </svg>
            </a>
          @else
            <a href="#" class="navbar-icon-btn" data-bs-toggle="modal" data-bs-target="#signIn" title="Keranjang">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h13L17 13M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
              </svg>
            </a>
          @endif

          {{-- Profile --}}
          @if(Auth::check())
            <a href="{{ route('user.profile', Auth::user()->id) }}" class="navbar-icon-btn" title="Profil">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </a>
          @else
            <a href="#" class="navbar-icon-btn" data-bs-toggle="modal" data-bs-target="#signIn" title="Profil">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </a>
          @endif
        </div>

      </div>
    </div>
</nav>