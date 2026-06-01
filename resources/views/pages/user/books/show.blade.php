@extends('layout.user.app')
@section('title', 'Detail Buku')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Buku</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $book->book_name }}</h4>
                            <a href="{{ route('user.books.index') }}" class="btn btn-secondary ml-auto">Kembali</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr><td width="40%"><strong>Kode Buku</strong></td><td>{{ $book->book_id }}</td></tr>
                                <tr><td><strong>Nama Buku</strong></td><td>{{ $book->book_name }}</td></tr>
                                <tr><td><strong>Penulis</strong></td><td>{{ $book->author }}</td></tr>
                                <tr><td><strong>Penerbit</strong></td><td>{{ $book->publisher }}</td></tr>
                                <tr><td><strong>Tahun Terbit</strong></td><td>{{ $book->publication_year }}</td></tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        @php $b = ['available'=>'success','unavailable'=>'danger','maintenance'=>'warning'][$book->status] ?? 'secondary'; @endphp
                                        <span class="badge badge-{{ $b }}">{{ ucfirst($book->status) }}</span>
                                    </td>
                                </tr>
                            </table>
                            @if($book->status === 'available')
                                <a href="{{ route('user.borrowings.create', $book->id) }}" class="btn btn-primary">Pinjam Buku Ini</a>
                            @else
                                <button class="btn btn-secondary" disabled>Tidak Tersedia</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
