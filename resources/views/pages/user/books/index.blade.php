@extends('layout.user.app')
@section('title', 'Daftar Buku Tersedia')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Buku Tersedia</h1>
        </div>

        <div class="section-body">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @forelse($rooms as $room)
                @if($room->books->count() > 0)
                    <h5 class="mt-4">{{ $room->room_name }} - {{ $room->location }}</h5>
                    <div class="row">
                        @foreach($room->books as $book)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $book->book_name }}</h5>
                                        <p class="card-text text-muted">Kode: {{ $book->book_code }}</p>
                                        <p class="card-text"><small>{{ $book->author }} | {{ $book->publisher }} | {{ $book->publication_year }}</small></p>
                                        <span class="badge badge-success">Tersedia</span>
                                        <div class="mt-2">
                                            <a href="{{ route('user.books.show', $book->id) }}" class="btn btn-sm btn-info">Detail</a>
                                            <a href="{{ route('user.borrowings.create', $book->id) }}" class="btn btn-sm btn-primary">Pinjam</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @empty
                <div class="alert alert-info">Belum ada Buku yang tersedia saat ini.</div>
            @endforelse
        </div>
    </section>
</div>
@endsection
