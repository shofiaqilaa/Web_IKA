@extends('layout.app')

@section('content')
<div class="container">
    <h2>Edit Data Alumni</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Perhatian!</strong> Ada kesalahan pada input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alumni.update', $alumni->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control"
                value="{{ old('nama_lengkap', $alumni->nama_lengkap) }}" required>
        </div>

        <!-- Tahun Lulus -->
        <div class="mb-3">
            <label class="form-label">Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control"
                value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}" required>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control"
                value="{{ old('jurusan', $alumni->jurusan) }}" required>
        </div>

        <!-- Nomor WA -->
        <div class="mb-3">
            <label class="form-label">Nomor WA</label>
            <input type="text" name="no_wa" class="form-control"
                value="{{ old('no_wa', $alumni->no_wa) }}" required>
        </div>

        <!-- Metode Pengiriman KTA -->
        <div class="mb-3">
            <label class="form-label">Metode Pengiriman KTA</label>
            <select name="metode_pengiriman_kta" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="cod" {{ $alumni->metode_pengiriman_kta == 'cod' ? 'selected' : '' }}>COD</option>
                <option value="diambil" {{ $alumni->metode_pengiriman_kta == 'diambil' ? 'selected' : '' }}>Diambil</option>
                <option value="dikirim" {{ $alumni->metode_pengiriman_kta == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
            </select>
        </div>

        <!-- Jumlah KTA -->
        <div class="mb-3">
            <label class="form-label">Jumlah KTA</label>
            <input type="number" name="jumlah_kta" class="form-control"
                value="{{ old('jumlah_kta', $alumni->jumlah_kta) }}" required>
        </div>

        <!-- Pas Foto -->
        <div class="mb-3">
            <label class="form-label">Pas Foto (biarkan kosong jika tidak ingin ganti)</label><br>

            @if ($alumni->pas_foto)
                <img src="{{ asset('storage/' . $alumni->pas_foto) }}" width="80" class="mb-2 rounded">
            @endif

            <input type="file" name="pas_foto" class="form-control" accept="image/*">
        </div>

        <!-- Bukti Transfer KTA -->
        <div class="mb-3">
            <label class="form-label">Bukti Transfer KTA (opsional)</label><br>

            @if ($alumni->bukti_transfer_kta)
                <img src="{{ asset('storage/' . $alumni->bukti_transfer_kta) }}" width="80" class="mb-2 rounded">
            @endif

            <input type="file" name="bukti_transfer_kta" class="form-control" accept="image/*">
        </div>

        <!-- Bersedia Donasi -->
        <div class="mb-3">
            <label class="form-label">Bersedia Donasi?</label>
            <select name="bersedia_donasi" class="form-control" required id="donasiSelect">
                <option value="tidak" {{ $alumni->bersedia_donasi == 'tidak' ? 'selected' : '' }}>Tidak</option>
                <option value="ya" {{ $alumni->bersedia_donasi == 'ya' ? 'selected' : '' }}>Ya</option>
            </select>
        </div>

        <!-- Jumlah Donasi -->
        <div class="mb-3" id="jumlahDonasiField" style="{{ $alumni->bersedia_donasi == 'ya' ? '' : 'display:none;' }}">
            <label class="form-label">Jumlah Donasi</label>
            <input type="number" name="jumlah_donasi" class="form-control"
                value="{{ old('jumlah_donasi', $alumni->jumlah_donasi) }}">
        </div>

        <!-- Bukti Transfer Donasi -->
        <div class="mb-3" id="buktiDonasiField" style="{{ $alumni->bersedia_donasi == 'ya' ? '' : 'display:none;' }}">
            <label class="form-label">Bukti Transfer Donasi</label><br>

            @if ($alumni->bukti_transfer_donasi)
                <img src="{{ asset('storage/' . $alumni->bukti_transfer_donasi) }}" width="80" class="mb-2 rounded">
            @endif

            <input type="file" name="bukti_transfer_donasi" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.getElementById('donasiSelect').addEventListener('change', function() {
    const show = this.value === 'ya';
    document.getElementById('jumlahDonasiField').style.display = show ? 'block' : 'none';
    document.getElementById('buktiDonasiField').style.display = show ? 'block' : 'none';
});
</script>

@endsection
