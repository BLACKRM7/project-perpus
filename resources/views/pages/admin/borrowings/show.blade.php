@extends('layout.admin.app')
@section('title', 'Detail Peminjaman')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Peminjaman</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Peminjaman #{{ $borrowing->id }}</h4>
                            <a href="{{ route('admin.borrowings.index') }}" class="btn btn-secondary ml-auto">Kembali</a>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table table-bordered">
                                <tr>
                                    <td width="30%"><strong>Peminjam</strong></td>
                                    <td>{{ $borrowing->user->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $borrowing->user->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Buku</strong></td>
                                    <td>{{ $borrowing->book->book_name ?? '-' }} ({{ $borrowing->book->book_code ?? '-' }})</td>
                                </tr>
                                <tr>
                                    <td><strong>Ruangan</strong></td>
                                    <td>{{ $borrowing->book->room->room_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tujuan</strong></td>
                                    <td>{{ $borrowing->purpose ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Pinjam</strong></td>
                                    <td>{{ $borrowing->borrow_date }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Kembali</strong></td>
                                    <td>{{ $borrowing->return_date ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Foto Identitas</strong></td>
                                    <td>
                                        @if($borrowing->identity_photo)
                                            <img src="{{ Storage::url($borrowing->identity_photo) }}"
                                                 alt="Foto Identitas {{ $borrowing->user->name ?? '' }}"
                                                 class="img-thumbnail"
                                                 style="max-width: 250px; cursor: pointer;"
                                                 onclick="openPhotoModal('{{ Storage::url($borrowing->identity_photo) }}', '{{ $borrowing->user->name ?? 'Pengguna' }}')">
                                            <br>
                                            <small class="text-muted">Klik untuk memperbesar</small>
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        @php
                                            $badge = ['pending'=>'warning','approved'=>'success','returned'=>'info','rejected'=>'danger'][$borrowing->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $badge }}">{{ ucfirst($borrowing->status) }}</span>
                                    </td>
                                </tr>
                                @if($borrowing->returnData)
                                    <tr>
                                        <td><strong>Dikembalikan Pada</strong></td>
                                        <td>{{ $borrowing->returnData->returned_at }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Catatan Kondisi</strong></td>
                                        <td>{{ $borrowing->returnData->condition_notes ?? '-' }}</td>
                                    </tr>
                                @endif
                            </table>

                            <a href="{{ route('admin.borrowings.edit', $borrowing->id) }}" class="btn btn-warning">Edit</a>
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
                <img id="modalPhotoImg" src="" alt="Foto Identitas" style="max-width:100%; max-height:500px;">
            </div>
        </div>
    </div>
</div>

<script>
function openPhotoModal(url, name) {
    document.getElementById('photoModalLabel').textContent = 'Foto Identitas — ' + name;
    document.getElementById('modalPhotoImg').src = url;
    $('#photoModal').modal('show');
}
</script>
@endsection
