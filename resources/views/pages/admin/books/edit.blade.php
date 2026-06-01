@extends('layout.admin.app')
@section('title', 'edit buku')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Halaman Edit Buku</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Form Edit Buku</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="room_id">Kategori Lantai / Ruangan</label>
                                    <select class="form-control @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                                        <option value="">Pilih Lantai / Kategori Buku</option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" {{ old('room_id', $book->room_id) == $room->id ? 'selected' : '' }}>{{ $room->room_name }} - {{ $room->location }}</option>
                                        @endforeach
                                    </select>
                                    @error('room_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="book_code">Book Code</label>
                                    <input type="text" class="form-control @error('book_code') is-invalid @enderror"
                                        id="book_code" name="book_code" value="{{ old('book_code', $book->book_code) }}"
                                        placeholder="Isi Book Code..." required>
                                    @error('book_code')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="book_name">Book Name</label>
                                    <input type="text" class="form-control @error('book_name') is-invalid @enderror"
                                        id="book_name" name="book_name" value="{{ old('book_name', $book->book_name) }}"
                                        placeholder="Isi Book Name..." required>
                                    @error('book_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                                            id="author" name="author" value="{{ old('author', $book->author) }}"
                                            placeholder="Isi Author..." required>
                                        @error('author')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="publisher">Publisher</label>
                                        <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                            id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}"
                                            placeholder="Isi Publisher..." required>
                                        @error('publisher')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">Pilih Status...</option>
                                        <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="unavailable" {{ old('status', $book->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection