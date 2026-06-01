@extends('layout.admin.app')
@section('title', 'Peminjaman')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Peminjaman</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Peminjaman</h4>
                                <a href="{{ route('admin.borrowings.create') }}" class="btn btn-primary ml-auto">Tambah Peminjaman</a>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Peminjam</th>
                                                <th>Buku</th>
                                                <th>Ruangan</th>
                                                <th>Tujuan</th>
                                                <th>Tgl Pinjam</th>
                                                <th>Tgl Kembali</th>
                                                <th>Foto Identitas</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($borrowings as $i => $borrowing)
                                                <tr>
                                                    <td>{{ $i + 1 }}</td>
                                                    <td>{{ $borrowing->user->name ?? '-' }}</td>
                                                    <td>{{ ($borrowing->book->book_name ?? '-') . ' (' . ($borrowing->book->book_id ?? '-') . ')' }}</td>
                                                    <td>{{ $borrowing->book->room->room_name ?? '-' }}</td>
                                                    <td>{{ Str::limit($borrowing->purpose, 30) ?? '-' }}</td>
                                                    <td>{{ $borrowing->borrow_date }}</td>
                                                    <td>{{ $borrowing->return_date ?? '-' }}</td>

                                                    {{-- Foto Identitas --}}
                                                    <td>
                                                        @if($borrowing->identity_photo)
                                                            <img src="{{ Storage::publicUrl($borrowing->identity_photo) }}"
                                                                 alt="Foto"
                                                                 class="img-thumbnail"
                                                                 style="max-width:70px; cursor:pointer;"
                                                                 onclick="openPhotoModal('{{ Storage::publicUrl($borrowing->identity_photo) }}', '{{ $borrowing->user->name ?? '-' }}')">
                                                        @else
                                                            <span class="text-muted small">Tidak ada</span>
                                                        @endif
                                                    </td>

                                                    {{-- Status Dropdown --}}
                                                    <td>
                                                        <form action="{{ route('admin.borrowings.updateStatus', $borrowing->id) }}"
                                                              method="POST" class="status-form">
                                                            @csrf
                                                            @method('PATCH')
                                                            <select name="status"
                                                                    class="form-control form-control-sm status-select"
                                                                    data-id="{{ $borrowing->id }}"
                                                                    style="min-width:110px;">
                                                                @foreach(['pending' => 'warning', 'approved' => 'success', 'returned' => 'info', 'rejected' => 'danger'] as $val => $color)
                                                                    <option value="{{ $val }}"
                                                                            {{ $borrowing->status == $val ? 'selected' : '' }}>
                                                                        {{ ucfirst($val) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </form>
                                                    </td>

                                                    {{-- Aksi --}}
                                                    <td>
                                                        <a href="{{ route('admin.borrowings.show', $borrowing->id) }}"
                                                           class="btn btn-sm btn-info">Detail</a>
                                                        <a href="{{ route('admin.borrowings.edit', $borrowing->id) }}"
                                                           class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="{{ route('admin.borrowings.destroy', $borrowing->id) }}"
                                                              method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">Belum ada data peminjaman.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="float-right mt-3">
                                    {{ $borrowings->links() }}
                                </div>
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
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalPhotoImg" src="" alt="Foto Identitas"
                         style="max-width:100%; max-height:500px;">
                </div>      
            </div>
        </div>
    </div>

    <script>
    // Open photo modal
    function openPhotoModal(url, name) {
        document.getElementById('photoModalLabel').textContent = 'Foto Identitas — ' + name;
        document.getElementById('modalPhotoImg').src = url;
        $('#photoModal').modal('show');
    }

    // Auto-submit status dropdown on change
    document.querySelectorAll('.status-select').forEach(function(select) {
        select.addEventListener('change', function() {
            if (confirm('Ubah status menjadi "' + this.options[this.selectedIndex].text + '"?')) {
                this.closest('form').submit();
            } else {
                // revert to original value stored in data attribute
                this.value = this.dataset.original || this.options[
                    Array.from(this.options).findIndex(o => o.defaultSelected)
                ].value;
            }
        });
        // store original value for revert
        select.dataset.original = select.value;
    });
    </script>
@endsection
