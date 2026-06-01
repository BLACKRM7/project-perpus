@extends('layout.admin.app')
@section('title', 'Detail Pengembalian')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pengembalian</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Pengembalian #{{ $return->id }}</h4>
                            <a href="{{ route('admin.returns.index') }}" class="btn btn-secondary ml-auto">Kembali</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr><td width="35%"><strong>Peminjam</strong></td><td>{{ $return->borrowing->user->name ?? '-' }}</td></tr>
                                <tr><td><strong>Email</strong></td><td>{{ $return->borrowing->user->email ?? '-' }}</td></tr>
                                <tr><td><strong>Buku</strong></td><td>{{ $return->borrowing->book->book_name ?? '-' }} ({{ $return->borrowing->book->book_code ?? '-' }})</td></tr>
                                <tr><td><strong>Ruangan</strong></td><td>{{ $return->borrowing->book->room->room_name ?? '-' }}</td></tr>
                                <tr><td><strong>Tanggal Pinjam</strong></td><td>{{ $return->borrowing->borrow_date }}</td></tr>
                                <tr><td><strong>Dikembalikan Pada</strong></td><td>{{ $return->returned_at }}</td></tr>
                                <tr><td><strong>Catatan Kondisi</strong></td><td>{{ $return->condition_notes ?? '-' }}</td></tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>
                                        @php $s = $return->borrowing->status ?? ''; $b = ['pending'=>'warning','approved'=>'success','returned'=>'info','rejected'=>'danger'][$s] ?? 'secondary'; @endphp
                                        <span class="badge badge-{{ $b }}">{{ ucfirst($s) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
