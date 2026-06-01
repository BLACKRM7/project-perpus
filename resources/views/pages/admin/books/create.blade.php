@extends('layout.admin.app')
@section('title', 'tambah buku')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Tambah Buku</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark">Form Tambah Buku</h4>
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
                        <form action="{{ route('admin.books.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="room_id">Room ID</label>
                                        <select class="form-control @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                                            <option value="">Pilih Lantai / Kategori Buku</option>
                                            @foreach($rooms as $room)
                                                <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->room_name }} - {{ $room->location }}</option>
                                            @endforeach
                                        </select>
                                        @error('room_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="book_id">Book ID</label>
                                        <input type="text" class="form-control @error('book_id') is-invalid @enderror" 
                                            id="book_id" name="book_id" value="{{ old('book_id') }}"
                                            placeholder="Isi Book ID..." required>
                                        @error('book_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="book_name">Book Name</label>
                                        <input type="text" class="form-control @error('book_name') is-invalid @enderror" 
                                            id="book_name" name="book_name" value="{{ old('book_name') }}"
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
                                            id="author" name="author" value="{{ old('author') }}"
                                            placeholder="Isi Penulis..." required>
                                        @error('author')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="publisher">Publisher</label>
                                        <input type="text" class="form-control @error('publisher') is-invalid @enderror" 
                                            id="publisher" name="publisher" value="{{ old('publisher') }}"
                                            placeholder="Isi Penerbit..." required>
                                        @error('publisher')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="publication_year">Publication Year</label>
                                        <input type="number" class="form-control @error('publication_year') is-invalid @enderror" 
                                            id="publication_year" name="publication_year" value="{{ old('publication_year') }}"
                                            placeholder="Isi Tahun Terbit..." required>
                                        @error('publication_year')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12"></div>
                                    <div class="choice">
                                        <label for="status">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                            <option value="">Pilih Status...</option>
                                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>unavailable</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection