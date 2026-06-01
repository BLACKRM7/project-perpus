@extends('layout.admin.app')
@section('title', 'Pengembalian')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Halaman Pengembalian</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Pengembalian</h4>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Peminjam</th>
                                            <th>Buku</th>
                                            <th>Ruangan</th>
                                            <th>Dikembalikan Pada</th>
                                            <th>Catatan Kondisi</th>
                                            <th>Status Peminjaman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($returns as $i => $return)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $return->borrowing->user->name ?? '-' }}</td>
                                                <td>{{ $return->borrowing->book->book_name ?? '-' }}</td>
                                                <td>{{ $return->borrowing->book->room->room_name ?? '-' }}</td>
                                                <td>{{ $return->returned_at }}</td>
                                                <td>{{ $return->condition_notes ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        $status = $return->borrowing->status ?? 'unknown';
                                                        $badge = ['pending'=>'warning','approved'=>'success','returned'=>'info','rejected'=>'danger'][$status] ?? 'secondary';
                                                    @endphp
                                                    <span class="badge badge-{{ $badge }}">{{ ucfirst($status) }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.returns.show', $return->id) }}" class="btn btn-sm btn-info">Detail</a>
                                                    @if($return->borrowing->status === 'approved')
                                                        <form action="{{ route('admin.returns.approve', $return->id) }}" method="POST" style="display:inline;">
                                                            @csrf @method('PATCH')
                                                            <button class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pengembalian?')">Konfirmasi</button>
                                                        </form>
                                                        <form action="{{ route('admin.returns.reject', $return->id) }}" method="POST" style="display:inline;">
                                                            @csrf @method('PATCH')
                                                            <button class="btn btn-sm btn-warning" onclick="return confirm('Tolak pengembalian?')">Tolak</button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.returns.destroy', $return->id) }}" method="POST" style="display:inline;">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            @if($returnedBorrowings->isEmpty())
                                                <tr>
                                                    <td colspan="8" class="text-center">Belum ada data pengembalian.</td>
                                                </tr>
                                            @endif
                                        @endforelse

                                        @foreach($returnedBorrowings as $index => $borrowing)
                                            <tr>
                                                <td>{{ $returns->count() + $index + 1 }}</td>
                                                <td>{{ $borrowing->user->name ?? '-' }}</td>
                                                <td>{{ $borrowing->book->book_name ?? '-' }}</td>
                                                <td>{{ $borrowing->book->room->room_name ?? '-' }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td><span class="badge badge-info">Returned</span></td>
                                                <td>
                                                    <a href="{{ route('admin.borrowings.show', $borrowing->id) }}" class="btn btn-sm btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
