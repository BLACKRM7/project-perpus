@extends('layout.user.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard User</h1>
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
                            <p>Dashboard ini adalah area khusus untuk user biasa. Anda dapat mengelola peminjaman PC dan melihat riwayat aktivitas dari sini.</p>
                            <div class="alert alert-info">
                                <strong>Info:</strong> Gunakan menu di sebelah kiri untuk navigasi ke berbagai fitur yang tersedia.
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Informasi Profil</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr>
                                        <td width="30%"><strong>Nama:</strong></td>
                                        <td>{{ auth()->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email:</strong></td>
                                        <td>{{ auth()->user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Role/Status:</strong></td>
                                        <td>
                                            <div class="badge badge-info">{{ strtoupper(auth()->user()->role) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Bergabung Sejak:</strong></td>
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

                    <!-- Available Features -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Fitur yang Tersedia</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-info">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-laptop"></i> Daftar Buku
                                            </h5>
                                            <p class="card-text small">Lihat daftar buku yang tersedia untuk dipinjam</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-success">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-handshake"></i> Peminjaman Saya
                                            </h5>
                                            <p class="card-text small">Lihat daftar buku yang sedang Anda pinjam</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <i class="fas fa-cog"></i> Pengaturan Profil
                                            </h5>
                                            <p class="card-text small">Ubah informasi profil dan password</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <!-- Statistics Card -->
                    <div class="card bg-primary text-white">
                        <div class="card-header">
                            <h4 class="text-white">Statistik</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-flex-end">
                                <div class="col col-stats ms-3 ms-xl-0">
                                    <div class="numbers">
                                        <p class="state text-truncate text-secondary text-white-80">Total Peminjaman</p>
                                        <h3 class="counter text-white">{{ \App\Models\Borrowing::where('user_id', auth()->id())->count() }}</h3>
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

                    <!-- Quick Links -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Quick Links</h4>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a href="{{ route('user.books.index') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="mb-0"><strong>Daftar Buku</strong></p>
                                            <small class="text-muted">Lihat buku yang tersedia</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('user.borrowings.index') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="mb-0"><strong>Peminjaman Aktif</strong></p>
                                            <small class="text-muted">Lihat peminjaman aktif</small>
                                        </div>
                                    </div>
                                </a>
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