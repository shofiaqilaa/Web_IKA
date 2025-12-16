@extends('layout.app')

@section('content')
<h1>Galeri Usaha Alumni</h1>

<a href="{{ route('galeri.create') }}" class="btn btn-primary mb-3">Tambah Galeri</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($galeri as $galeri)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $galeri->judul }}</td>
            <td>{{ $galeri->deskripsi }}</td>
            <td>
                @if($galeri->gambar)
                    <img src="{{ asset('storage/'.$galeri->gambar) }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('galeri.edit', $galeri->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('galeri.destroy', $galeri->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
