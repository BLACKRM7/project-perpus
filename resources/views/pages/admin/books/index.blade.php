@extends('layout.admin.app')
@section('title', 'Buku')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Halaman Buku</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Buku</h4>
                            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Tambah Buku</a>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @forelse($rooms as $room)
                            <h5 class="mt-4">{{ $room->room_name }} - {{ $room->location }}</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md mb-4">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Book ID</th>
                                            <th>Book Name</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($room->books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td>{{ $book->book_id }}</td>
                                            <td>{{ $book->book_name }}</td>
                                            <td>
                                                @if($book->status == 'available')
                                                    <span class="badge badge-success">Tersedia</span>
                                                @elseif($book->status == 'borrowed')
                                                    <span class="badge badge-warning">Dipinjam</span>
                                                @elseif($book->status == 'maintenance')
                                                    <span class="badge badge-danger">Maintenance</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ ucfirst($book->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada buku untuk {{ $room->room_name }}.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @empty
                            <div class="alert alert-info">Belum ada ruangan terdaftar. Tambahkan room terlebih dahulu.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection