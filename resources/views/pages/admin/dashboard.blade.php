@extends('layout.admin.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header" style="text-align: center;">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <!-- Welcome Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Selamat Datang, {{ auth()->user()->name }}!</h4>
                        </div>
                        <div class="card-body">
                            <p>Anda telah berhasil login sebagai <strong>{{ auth()->user()->role }}</strong></p>
                            <p>Dashboard admin ini memberikan akses penuh untuk mengelola sistem peminjaman Buku, user, dan semua fitur administrasi lainnya.</p>
                            <div class="alert alert-success">
                                <strong>Status:</strong> Sistem berjalan normal. Gunakan menu di sebelah kiri untuk navigasi.
                            </div>
                        </div>
                    </div>

                    <!-- Admin Profile Information -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Informasi Admin</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td width="30%"><strong>Nama Admin:</strong></td>
                                        <td>{{ auth()->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ auth()->user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Role/Status:</strong></td>
                                        <td>
                                            <div class="badge badge-danger">{{ strtoupper(auth()->user()->role) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dibuat Sejak:</strong></td>
                                        <td>{{ auth()->user()->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Update Terakhir:</strong></td>
                                        <td>{{ auth()->user()->updated_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Available Admin Features -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Fitur Admin</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-primary">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-users"></i> Manajemen User
                                            </h5>
                                            <p class="card-text small">Kelola user, admin, dan permission</p>
                                            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">Buka</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-success">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-laptop"></i> Manajemen Buku
                                            </h5>
                                            <p class="card-text small">Kelola daftar Buku dan ketersediaan</p>
                                            <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-success">Buka</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-warning">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-handshake"></i> Manajemen Peminjaman
                                            </h5>
                                            <p class="card-text small">Monitor peminjaman dan pengembalian</p>
                                            <a href="{{ route('admin.borrowings.index') }}" class="btn btn-sm btn-warning">Buka</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-info">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-building"></i> Manajemen Ruangan
                                            </h5>
                                            <p class="card-text small">Atur ruangan dan lokasi Buku</p>
                                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-info">Buka</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-danger">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-history"></i> Activity Log
                                            </h5>
                                            <p class="card-text small">Lihat log aktivitas sistem</p>
                                            <a href="{{ route('admin.returns.index') }}" class="btn btn-sm btn-danger">Buka</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <!-- System Statistics -->
                    <div class="card bg-danger text-white">
                        <div class="card-header">
                            <h4 class="text-white">Statistik Sistem</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-flex-end">
                                <div class="col col-stats ms-3 ms-xl-0">
                                    <div class="numbers">
                                        <p class="state text-truncate text-secondary text-white-80">Total User</p>
                                        <h3 class="counter text-white">{{ \App\Models\User::where('role', 'user')->count() }}</h3>
                                    </div>
                                </div>
                                <div class="col col-stats text-white text-end">
                                    <div class="chartjs-wrapper h-5rem">
                                        <i class="fas fa-users fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buku Statistics -->
                    <div class="card bg-info text-white">
                        <div class="card-header">
                            <h4 class="text-white">Total Buku</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-flex-end">
                                <div class="col col-stats ms-3 ms-xl-0">
                                    <div class="numbers">
                                        <p class="state text-truncate text-secondary text-white-80">Buku Terdaftar</p>
                                        <h3 class="counter text-white">{{ \App\Models\Book::count() }}</h3>
                                    </div>
                                </div>
                                <div class="col col-stats text-white text-end">
                                    <div class="chartjs-wrapper h-5rem">
                                        <i class="fas fa-laptop fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Borrowing Statistics -->
                    <div class="card bg-warning text-white">
                        <div class="card-header">
                            <h4 class="text-white">Peminjaman Aktif</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-flex-end">
                                <div class="col col-stats ms-3 ms-xl-0">
                                    <div class="numbers">
                                        <p class="state text-truncate text-secondary text-white-80">Aktif Sekarang</p>
                                        <h3 class="counter text-white">{{ $activeBorrowings }}</h3>
                                    </div>
                                </div>
                                <div class="col col-stats text-white text-end">
                                    <div class="chartjs-wrapper h-5rem">
                                        <i class="fas fa-handshake fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Quick Links</h4>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="mb-0"><strong>Kelola User</strong></p>
                                            <small class="text-muted">Tambah, edit, hapus user</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('admin.returns.index') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="mb-0"><strong>Lihat Laporan</strong></p>
                                            <small class="text-muted">Laporan peminjaman & pengembalian</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
