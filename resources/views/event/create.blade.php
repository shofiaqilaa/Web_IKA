@extends('layout.app')

@section('content')

<div class="card">
    <div class="card-header bg-success text-white">
        <h3>Tambah Event</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Judul Event</label>
                <input type="text" name="judul_event" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi Event</label>
                <textarea name="deskripsi_event" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal Event</label>
                <input type="date" name="tanggal_event" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Gambar Event (Optional)</label>
                <input type="file" name="gambar_event" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>
</div>

@endsection
