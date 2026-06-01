@extends('layout.admin.app')
@section('title', 'Tambah Peminjaman')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Peminjaman</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Peminjaman</h4>
                            <a href="{{ route('admin.borrowings.index') }}" class="btn btn-secondary ml-auto">Kembali</a>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.borrowings.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Peminjam <span class="text-danger">*</span></label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih User --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Buku <span class="text-danger">*</span></label>
                                    <select name="book_id" class="form-control @error('book_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Buku --</option>
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                                {{ $book->book_name }} ({{ $book->book_id }}) — {{ $book->room->room_name ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Pinjam <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="borrow_date"
                                           value="{{ old('borrow_date') }}"
                                           class="form-control @error('borrow_date') is-invalid @enderror" required>
                                    @error('borrow_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Kembali <small class="text-muted">(opsional)</small></label>
                                    <input type="datetime-local" name="return_date"
                                           value="{{ old('return_date') }}"
                                           class="form-control @error('return_date') is-invalid @enderror">
                                    @error('return_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Tujuan</label>
                                    <textarea name="purpose" class="form-control @error('purpose') is-invalid @enderror" rows="3">{{ old('purpose') }}</textarea>
                                    @error('purpose')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Foto Identitas <span class="text-danger">*</span></label>
                                    <input type="file" name="identity_photo" id="identity_photo_create"
                                           accept="image/*"
                                           class="form-control @error('identity_photo') is-invalid @enderror" required>
                                    <small class="form-text text-muted">Format JPG/PNG, maks 2MB.</small>
                                    @error('identity_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <div id="preview_create" class="mt-2" style="display:none;">
                                        <img id="preview_img_create" src="" alt="Preview" class="img-thumbnail" style="max-width: 220px;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="pending"  {{ old('status','pending') == 'pending'  ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="returned" {{ old('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.getElementById('identity_photo_create').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview_create');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('preview_img_create').src = ev.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
@endsection
