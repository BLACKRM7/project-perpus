@extends('layout.app')
@section('title', 'Buku')
@section('content')
 <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Halaman Buku</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List Buku</h4>
                                <a href="{{ route('buku.create') }}" class="btn btn-primary">Pinjam Buku</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th>Judul Buku</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach($bukus as $buku)
                                            <tr>
                                                <td>{{ $buku->buku_id }}</td>
                                                <td>{{ $buku->judul }}</td>
                                                <td>{{ $buku->pengarang }}</td>
                                                <td>{{ $buku->penerbit }}</td>
                                                <td>{{ $buku->tahun_terbit }}</td>
                                                <td>{{ $buku->stok }}</td>
                                                <td>
                                                    <a href="{{ route('buku.edit', $buku->buku_id) }}" class="btn btn-warning">Edit</a>
                                                    <a href="#" class="btn btn-danger" onclick="handleDelete({{ $buku->buku_id }})">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <form id="form-delete" action="" method="POST">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1"><i
                                                    class="fas fa-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                                    class="sr-only">(current)</span></a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@push('js')
<script>
    function handleDelete(id) {
      $('#form-delete').attr('action', '/buku/' + id);
      var check = confirm('APakah anda yakin ingin menghapus data ini?');
      if(check) {
        $('#form-delete').submit();
      }
    }

    function handleEdit(id) {
            window.location.href = "/buku/" + id + "/edit/";
        }
</script>
@endpush
@endsection