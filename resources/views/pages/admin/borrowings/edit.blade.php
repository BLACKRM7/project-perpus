@extends('layout.admin.app')
@section('title', 'Edit Peminjaman')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Peminjaman</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Peminjaman</h4>
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

                            <form action="{{ route('admin.borrowings.update', $borrowing->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Peminjam</label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih User --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $borrowing->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Buku</label>
                                    <select name="pc_id" class="form-control @error('pc_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Buku --</option>
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}" {{ old('pc_id', $borrowing->pc_id) == $book->id ? 'selected' : '' }}>
                                                {{ $book->book_name }} ({{ $book->book_code }}) — {{ $book->room->room_name ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pc_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Pinjam</label>
                                    <input type="datetime-local" name="borrow_date"
                                           value="{{ old('borrow_date', \Carbon\Carbon::parse($borrowing->borrow_date)->format('Y-m-d\TH:i')) }}"
                                           class="form-control @error('borrow_date') is-invalid @enderror" required>
                                    @error('borrow_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Kembali <small class="text-muted">(opsional)</small></label>
                                    <input type="datetime-local" name="return_date"
                                           value="{{ old('return_date', $borrowing->return_date ? \Carbon\Carbon::parse($borrowing->return_date)->format('Y-m-d\TH:i') : '') }}"
                                           class="form-control @error('return_date') is-invalid @enderror">
                                    @error('return_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Tujuan</label>
                                    <textarea name="purpose" class="form-control @error('purpose') is-invalid @enderror" rows="3">{{ old('purpose', $borrowing->purpose) }}</textarea>
                                    @error('purpose')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        @foreach(['pending','approved','returned','rejected'] as $s)
                                            <option value="{{ $s }}" {{ old('status', $borrowing->status) == $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group">
                                    <label>Foto Identitas</label>
                                    @if($borrowing->identity_photo)
                                        <div class="mb-2">
                                            <p class="text-muted mb-1">Foto saat ini:</p>
                                            <img src="{{ Storage::url($borrowing->identity_photo) }}"
                                                 alt="Foto Identitas"
                                                 class="img-thumbnail"
                                                 style="max-width: 220px; cursor: pointer;"
                                                 onclick="openPhotoModal('{{ Storage::url($borrowing->identity_photo) }}', '{{ $borrowing->user->name ?? '' }}')">
                                            <br><small class="text-muted">Klik untuk memperbesar</small>
                                        </div>
                                    @endif
                                    <input type="file" name="identity_photo" id="identity_photo_edit"
                                           accept="image/*"
                                           class="form-control @error('identity_photo') is-invalid @enderror">
                                    <small class="form-text text-muted">
                                        {{ $borrowing->identity_photo ? 'Upload file baru untuk mengganti foto. Biarkan kosong jika tidak ingin mengubah.' : 'Upload foto identitas (JPG/PNG, maks 2MB).' }}
                                    </small>
                                    @error('identity_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <div id="preview_edit" class="mt-2" style="display:none;">
                                        <p class="text-muted mb-1">Preview foto baru:</p>
                                        <img id="preview_img_edit" src="" alt="Preview" class="img-thumbnail" style="max-width: 220px;">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Photo Modal -->
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="photoModalLabel">Foto Identitas</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPhotoImg" src="" alt="Foto Identitas" style="max-width:100%; max-height:500px;">
            </div>
        </div>
    </div>
</div>

<script>
function openPhotoModal(url, name) {
    document.getElementById('photoModalLabel').textContent = 'Foto Identitas' + (name ? ' — ' + name : '');
    document.getElementById('modalPhotoImg').src = url;
    $('#photoModal').modal('show');
}

document.getElementById('identity_photo_edit').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview_edit');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            document.getElementById('preview_img_edit').src = ev.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});
</script>
@endsection
