<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Mini Project</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

  <style>
    .login-brand {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-brand img {
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
  </style>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <h3 style="color: #6777ef; font-weight: bold;">Perpustakaan</h3>
              <p style="color: #6c757d; font-size: 14px;">Sistem Peminjaman Buku - Login</p>
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
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <form action="{{ route('post.login') }}" method="POST" class="needs-validation" novalidate>
                  @csrf

                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                      name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                    @error('email')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                      name="password" tabindex="2" required>
                    @error('password')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                      <label class="custom-control-label" for="customCheck1">Ingat saya</label>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary btn-block" tabindex="4">Login</button>
                </form>
              </div>
            </div>

            <div class="mt-4 text-center">
              <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="font-weight-bold">Daftar Sekarang</a></p>
            </div>

            <div class="mt-4 text-center text-muted small">
              <p>Demo Akun:</p>
              <p><strong>Admin:</strong> admin@example.com | password</p>
              <p><strong>User:</strong> user@example.com | password</p>
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
  </script>
</body>

</html>