@extends('layout.user.app')
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
                            <h4>Peminjaman #{{ $borrowing->id }}</h4>
                            <a href="{{ route('user.borrowings.index') }}" class="btn btn-secondary ml-auto">Kembali</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td width="35%"><strong>Buku</strong></td>
                                    <td>{{ ($borrowing->book->book_name ?? '-') . ' (' . ($borrowing->book->book_id ?? '-') . ')' }}</td>
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
                                            <img src="{{ Storage::publicUrl($borrowing->identity_photo) }}"
                                                 alt="Foto Identitas"
                                                 class="img-thumbnail"
                                                 style="max-width:200px; cursor:pointer;"
                                                 onclick="openPhotoModal('{{ Storage::publicUrl($borrowing->identity_photo) }}')">
                                            <br><small class="text-muted">Klik untuk memperbesar</small>
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        @php
                                            $b = ['pending'=>'warning','approved'=>'success','returned'=>'info','rejected'=>'danger'][$borrowing->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $b }}">{{ ucfirst($borrowing->status) }}</span>
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
                <h5 class="modal-title">Foto Identitas</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPhotoImg" src="" alt="Foto Identitas" style="max-width:100%; max-height:500px;">
            </div>
        </div>
    </div>
</div>

<script>
function openPhotoModal(url) {
    document.getElementById('modalPhotoImg').src = url;
    $('#photoModal').modal('show');
}
</script>
@endsection
