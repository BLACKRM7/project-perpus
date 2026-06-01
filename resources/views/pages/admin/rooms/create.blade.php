@extends('layout.admin.app')
@section('title', 'tambah rooms')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Halaman Tambah rooms</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Form Tambah rooms</h4>
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
                    <form action="{{ route('admin.rooms.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="room_name">Room Name</label>
                                    <input type="text" class="form-control @error('room_name') is-invalid @enderror"
                                        id="room_name" name="room_name" value="{{ old('room_name') }}"
                                        placeholder="Isi Room Name..." required>
                                    @error('room_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location') }}"
                                        placeholder="Isi Location..." required>
                                    @error('location')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
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
                                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>

                        </div>
                </div>
                </form>
            </div>
        </div>
</div>
</section>
</div>
@endsection