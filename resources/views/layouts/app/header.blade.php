<header class="custom-header">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
          <img src="{{ asset('assets/logo/logo_leet.png') }}" alt="Logo" width="28" height="28" class="logo-img">
          @if(Auth::check())
            <span class="header-text status"><a href="{{ route('user.pesanan', Auth::user()->id) }}">📦 Status Pesanan</a></span>
          @else
            <span class="header-text status"><a href="#" data-bs-toggle="modal" data-bs-target="#signIn">📦 Status Pesanan</a></span>
          @endif
        </div>

        <div class="text-end d-flex align-items-center gap-2">
            @if(Auth::check())
                <a href="{{ route('user.profile', Auth::user()->id) }}" class="text-decoration-none" style="color:#ccc; font-size:0.85rem;">
                    👤 {{ Auth::user()->name }}
                </a>
                <a href="{{ route('logout') }}" class="text-decoration-none" style="color:#aaa; font-size:0.82rem;">Keluar</a>
            @else
                <a href="" data-bs-toggle="modal" data-bs-target="#signIn" style="color:#ccc; font-size:0.85rem; text-decoration:none;">Masuk</a>
                <span style="color:#555;">/</span>
                <a href="#" data-bs-toggle="modal" data-bs-target="#signUp" style="color:#ccc; font-size:0.85rem; text-decoration:none;">Daftar</a>
            @endif
        </div>
      </div>
    </div>
</header>

<!-- Modal Sign In -->
<div class="modal fade" id="signIn" tabindex="-1" aria-labelledby="signInLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <img src="{{ asset('assets/logo/leet_navbar.png') }}" alt="Logo" width="36" height="36" class="logo-img me-2" style="border-radius:6px;">
              <h5 class="modal-title" id="signInLabel">Masuk ke Akun</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              @if(session('error'))
                <div class="alert alert-danger py-2 mb-3" style="font-size:0.85rem;">{{ session('error') }}</div>
              @endif
              <form method="POST" action="{{ route('login-proses') }}">
                  @csrf
                  <div class="mb-3">
                      <label for="signInEmail" class="form-label">Email</label>
                      <input type="email" class="form-control" id="signInEmail" name="email" placeholder="nama@email.com" required>
                      @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                  </div>
                  <div class="mb-3">
                      <label for="signInPassword" class="form-label">Password</label>
                      <input type="password" class="form-control" id="signInPassword" name="password" placeholder="Masukkan password" required>
                      @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                  </div>
                  <button type="submit" class="btn btn-primary w-100 mt-1">Masuk</button>
                  <p class="d-flex justify-content-center mt-3 mb-0" style="font-size:0.875rem;">
                    Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#signUp" class="ms-1">Daftar sekarang</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</div>

<!-- Modal Sign Up -->
<div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <img src="{{ asset('assets/logo/leet_navbar.png') }}" alt="Logo" width="36" height="36" class="logo-img me-2" style="border-radius:6px;">
              <h5 class="modal-title" id="signUpLabel">Buat Akun Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('register-proses') }}">
                  @csrf
                  <div class="row g-3">
                    <div class="col-6">
                      <label for="signUpName" class="form-label">Nama Lengkap</label>
                      <input type="text" class="form-control" id="signUpName" name="name" placeholder="Nama kamu" required>
                    </div>
                    <div class="col-6">
                      <label for="signUpUsername" class="form-label">Username</label>
                      <input type="text" class="form-control" id="signUpUsername" name="username" placeholder="username" required>
                    </div>
                    <div class="col-12">
                      <label for="signUpEmail" class="form-label">Email</label>
                      <input type="email" class="form-control" id="signUpEmail" name="email" placeholder="nama@email.com" required>
                    </div>
                    <div class="col-6">
                      <label for="signUpNoHP" class="form-label">No. HP</label>
                      <input type="text" class="form-control" id="signUpNoHP" name="no_hp" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="col-6">
                      <label for="signUpAlamat" class="form-label">Alamat</label>
                      <input type="text" class="form-control" id="signUpAlamat" name="alamat" placeholder="Alamat kamu" required>
                    </div>
                    <div class="col-6">
                      <label for="signUpPassword" class="form-label">Password</label>
                      <input type="password" class="form-control" id="signUpPassword" name="password" placeholder="Password" required>
                    </div>
                    <div class="col-6">
                      <label for="confirmPassword" class="form-label">Konfirmasi</label>
                      <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Ulangi password" required>
                    </div>
                    <div class="col-12 mt-1">
                      <button type="submit" class="btn btn-primary w-100">Buat Akun</button>
                      <p class="d-flex justify-content-center mt-3 mb-0" style="font-size:0.875rem;">
                        Sudah punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#signIn" class="ms-1">Masuk di sini</a>
                      </p>
                    </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>