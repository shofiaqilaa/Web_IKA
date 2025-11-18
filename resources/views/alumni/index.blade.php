@extends('layout.app')

@section('content')
<div class="container">
    <h2>Data Alumni</h2>

    <a href="{{ route('alumni.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Angkatan Kuliah</th>
                    <th>Jurusan</th>
                    <th>Nomor WA</th>
                    <th>Alamat</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($alumni as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->angkatan }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>{{ $item->alamat }}</td>

                    <td>
                        <a href="{{ route('alumni.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('alumni.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data alumni</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
