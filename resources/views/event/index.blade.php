@extends('layout.app')

@php 
    use Illuminate\Support\Str; 
@endphp

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Data Event</h3>
    </div>

    <div class="card-body">

        <a href="{{ route('event.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Event
        </a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Judul Event</th>
                    <th>Kategori</th>
                    <th>Tujuan Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($events as $e)
                <tr>
                    <td>{{ $e->judul_event }}</td>
                    <td>{{ $e->kategori ?? '-' }}</td>
                    <td>{{ Str::limit($e->tujuan_kegiatan ?? '-', 50) }}</td>
                    <td>{{ Str::limit($e->deskripsi_event, 50) }}</td>
                    <td>{{ $e->tanggal_event }}</td>

                    <td>
                        @if ($e->gambar_event)
                            <img src="{{ asset('storage/' . $e->gambar_event) }}" width="100">
                        @else
                            <small class="text-muted">Tidak ada</small>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('event.edit', $e->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('event.destroy', $e->id) }}" 
                              method="POST" 
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin mau hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data event</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
