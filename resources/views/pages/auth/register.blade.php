<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Mini Project</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  <style>
    .register-brand {
      text-align: center;
      margin-bottom: 30px;
    }

    .register-brand img {
      max-width: 100px;
      margin-bottom: 20px;
    }

    .card-primary {
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .form-group label {
      color: #495057;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .invalid-feedback {
      display: block;
      color: #dc3545;
      font-size: 0.875rem;
      margin-top: 5px;
    }

    .alert {
      border-radius: 4px;
    }

    .password-requirements {
      font-size: 0.875rem;
      margin-top: 10px;
      padding: 10px;
      background-color: #f8f9fa;
      border-radius: 4px;
    }

    .password-requirements ul {
      margin: 0;
      padding-left: 20px;
    }

    .password-requirements li {
      color: #6c757d;
    }
  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="register-brand">
              <h3 style="color: #6777ef; font-weight: bold;">Mini Project</h3>
              <p style="color: #6c757d; font-size: 14px;">Sistem Peminjaman PC - Daftar Akun</p>
            </div>

            @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Terjadi Kesalahan!</strong>
                <ul class="mb-0 mt-2">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="card card-primary">
              <div class="card-header">
                <h4>Daftar Akun Baru</h4>
              </div>

              <div class="card-body">
                <form action="{{ route('post.register') }}" method="POST" class="needs-validation" novalidate>
                  @csrf

                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                      name="name" value="{{ old('name') }}" tabindex="1" required autofocus>
                    @error('name')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                      name="email" value="{{ old('email') }}" tabindex="2" required>
                    @error('email')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                      name="password" id="password" tabindex="3" required>
                    @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <div class="password-requirements">
                      <strong>Persyaratan Password:</strong>
                      <ul>
                        <li>Minimal 6 karakter</li>
                        <li>Gunakan kombinasi huruf besar, kecil, dan angka</li>
                      </ul>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                      name="password_confirmation" tabindex="4" required>
                    @error('password_confirmation')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">
                        Saya setuju dengan syarat dan kondisi
                      </label>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary btn-block" tabindex="5">Daftar</button>
                </form>
              </div>
            </div>

            <div class="mt-4 text-center">
              <p class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="font-weight-bold">Login Sekarang</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <script>
    // Bootstrap form validation
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.querySelectorAll('.needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    // Validasi password matching
    document.getElementById('password').addEventListener('change', function() {
      var password = this.value;
      var confirm = document.querySelector('input[name="password_confirmation"]');
      if (confirm && confirm.value && password !== confirm.value) {
        confirm.classList.add('is-invalid');
      } else if (confirm) {
        confirm.classList.remove('is-invalid');
      }
    });
  </script>
</body>

</html>
