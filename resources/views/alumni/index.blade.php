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
                    <th>Tahun Lulus</th>
                    <th>Jurusan</th>
                    <th>No WA</th>
                    <th>Metode Pengiriman KTA</th>
                    <th>Jumlah KTA</th>
                    <th>Pas Foto</th>
                    <th>Bukti Transfer KTA</th>
                    <th>Bersedia Donasi</th>
                    <th>Jumlah Donasi</th>
                    <th>Bukti Transfer Donasi</th>
                    <th>Alamat</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($alumni as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->tahun_lulus }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->no_wa }}</td>
                    <td>{{ $item->metode_pengiriman_kta }}</td>
                    <td>{{ $item->jumlah_kta }}</td>

                    <!-- Pas Foto -->
                    <td>
                        @if($item->pas_foto)
                            <a href="{{ asset('storage/' . $item->pas_foto) }}" target="_blank" class="btn btn-info btn-sm">
                                Lihat
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <!-- Bukti Transfer KTA -->
                    <td>
                        @if($item->bukti_transfer_kta)
                            <a href="{{ asset('storage/' . $item->bukti_transfer_kta) }}" target="_blank" class="btn btn-info btn-sm">
                                Lihat
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <!-- Bersedia Donasi -->
                    <td>{{ $item->bersedia_donasi ? 'Ya' : 'Tidak' }}</td>

                    <!-- Jumlah Donasi -->
                    <td>{{ $item->jumlah_donasi ?? '-' }}</td>

                    <!-- Bukti Donasi -->
                    <td>
                        @if($item->bukti_transfer_donasi)
                            <a href="{{ asset('storage/' . $item->bukti_transfer_donasi) }}" target="_blank" class="btn btn-info btn-sm">
                                Lihat
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <td>{{ $item->alamat }}</td>

                    <td>
                        <a href="{{ route('alumni.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('alumni.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="14" class="text-center">Belum ada data alumni</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
