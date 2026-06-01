@extends('layout.user.app')
@section('title', 'Pinjam Buku')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Peminjaman Buku</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pinjam: {{ $book->book_name }} ({{ $book->book_id }})</h4>
                            <a href="{{ route('user.books.index') }}" class="btn btn-secondary ml-auto">Kembali</a>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                                </div>
                            @endif

                            <div class="alert alert-info mb-3">
                                <strong>Info Buku:</strong>
                                {{ $book->book_name }} | {{ $book->author ?? '-' }} | {{ $book->publisher ?? '-' }} | {{ $book->publication_year ?? '-' }}<br>
                                <strong>Ruangan:</strong> {{ $book->room->room_name ?? '-' }} — {{ $book->room->location ?? '-' }}
                            </div>

                            <form action="{{ route('user.borrowings.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">

                                <div class="form-group">
                                    <label>Tanggal Pinjam <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="borrow_date"
                                           value="{{ old('borrow_date') ? \Carbon\Carbon::parse(old('borrow_date'))->format('Y-m-d\TH:i') : '' }}"
                                           class="form-control @error('borrow_date') is-invalid @enderror" required>
                                    @error('borrow_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Perkiraan Tanggal Kembali <small class="text-muted">(opsional)</small></label>
                                    <input type="datetime-local" name="return_date"
                                           value="{{ old('return_date') ? \Carbon\Carbon::parse(old('return_date'))->format('Y-m-d\TH:i') : '' }}"
                                           class="form-control @error('return_date') is-invalid @enderror">
                                    @error('return_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Tujuan Peminjaman</label>
                                    <textarea name="purpose"
                                              class="form-control @error('purpose') is-invalid @enderror"
                                              rows="3"
                                              placeholder="Jelaskan tujuan peminjaman...">{{ old('purpose') }}</textarea>
                                    @error('purpose')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Foto Identitas <span class="text-danger">*</span></label>
                                    <div class="alert alert-warning py-2 px-3 mb-2">
                                        <i class="fas fa-info-circle"></i>
                                        Upload foto KTP, kartu pelajar, atau identitas lain yang valid. Format JPG/PNG, maks 2MB.
                                    </div>
                                    <input type="file" name="identity_photo" id="identity_photo_user"
                                           accept="image/*"
                                           class="form-control @error('identity_photo') is-invalid @enderror" required>
                                    @error('identity_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <div id="preview_user" class="mt-3" style="display:none;">
                                        <p class="text-muted mb-1">Preview:</p>
                                        <img id="preview_img_user" src="" alt="Preview"
                                             class="img-thumbnail" style="max-width:250px;">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Kirim Permintaan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.getElementById('identity_photo_user').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview_user');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('preview_img_user').src = ev.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
@endsection
