@extends('layout.app')

@section('content')

<div class="card">
    <div class="card-header bg-warning text-white">
        <h3>Edit Event</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul Event</label>
                <input type="text" name="judul_event" class="form-control" value="{{ $event->judul_event }}" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi Event</label>
                <textarea name="deskripsi_event" class="form-control" rows="4" required>{{ $event->deskripsi_event }}</textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal Event</label>
                <input type="date" name="tanggal_event" class="form-control" value="{{ $event->tanggal_event }}" required>
            </div>

            <div class="mb-3">
                <label>Gambar Event</label><br>

                @if ($event->gambar_event)
                    <img src="{{ asset('storage/' . $event->gambar_event) }}" width="120" class="mb-2"><br>
                @endif

                <input type="file" name="gambar_event" class="form-control">
            </div>

            <div class="mb-3">
                <label>Kategori Event</label>
                <select name="kategori" class="form-control" required>
                    <option value="berita" {{ old('kategori', $event->kategori) == 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="beasiswa" {{ old('kategori', $event->kategori) == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                    <option value="donasi" {{ old('kategori', $event->kategori) == 'donasi' ? 'selected' : '' }}>Donasi</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Tujuan Kegiatan (opsional)</label>
                <textarea name="tujuan_kegiatan" class="form-control" rows="3">{{ old('tujuan_kegiatan', $event->tujuan_kegiatan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>

    </div>
</div>

@endsection
