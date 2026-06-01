@extends('layout.user.app')
@section('title', 'Riwayat Peminjaman')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Peminjaman Saya</h1>
            </div>

            <div class="section-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Peminjaman</h4>
                        <a href="{{ route('user.books.index') }}" class="btn btn-primary ml-auto">Pinjam Buku Baru</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Buku</th>
                                        <th>Ruangan</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($borrowings as $i => $borrowing)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $borrowing->book->book_name ?? '-' }} ({{ $borrowing->book->book_code ?? '-' }})</td>
                                            <td>{{ $borrowing->book->room->room_name ?? '-' }}</td>
                                            <td>{{ $borrowing->purpose ?? '-' }}</td>
                                            <td>{{ $borrowing->borrow_date }}</td>
                                            <td>{{ $borrowing->return_date ?? '-' }}</td>
                                            <td>
                                                @php $badge = ['pending' => 'warning', 'approved' => 'success', 'returned' => 'info', 'rejected' => 'danger'][$borrowing->status] ?? 'secondary'; @endphp
                                                <span class="badge badge-{{ $badge }}">{{ ucfirst($borrowing->status) }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.borrowings.show', $borrowing->id) }}"
                                                    class="btn btn-sm btn-info">Detail</a>
                                                @if($borrowing->status === 'pending')
                                                    <form action="{{ route('user.borrowings.destroy', $borrowing->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Batalkan peminjaman ini?')">Batalkan</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada riwayat peminjaman.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $borrowings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection