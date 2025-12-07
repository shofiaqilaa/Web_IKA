@extends('layout.app')

@section('content')
<div class="container">
    <h2>Form Registrasi Alumni</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Perhatian!</strong> Ada kesalahan pada inputan.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Lengkap -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
        </div>

        <!-- Tahun Lulus -->
        <div class="mb-3">
            <label class="form-label">Tahun Lulus</label>
            <input type="number" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus') }}" required>
        </div>

        <!-- Nomor WA -->
        <div class="mb-3">
            <label class="form-label">Nomor WA</label>
            <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa') }}" required>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
        </div>

        <!-- Metode Pengiriman KTA -->
        <div class="mb-3">
            <label class="form-label">Metode Pengiriman KTA</label>
            <select name="metode_pengiriman_kta" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="ambil langsung">Ambil Langsung</option>
                <option value="diantar">Diantar</option>
            </select>
        </div>

        <!-- Jumlah KTA -->
        <div class="mb-3">
            <label class="form-label">Jumlah KTA</label>
            <input type="number" name="jumlah_kta" class="form-control" value="{{ old('jumlah_kta') }}" required>
        </div>

        <!-- Pas Foto -->
        <div class="mb-3">
            <label class="form-label">Pas Foto (jpg/png)</label>
            <input type="file" name="pas_foto" class="form-control" required>
        </div>

        <!-- Bukti Transfer KTA -->
        <div class="mb-3">
            <label class="form-label">Bukti Transfer KTA (jpg/png)</label>
            <input type="file" name="bukti_transfer_kta" class="form-control" required>
        </div>

        <!-- Bersedia Donasi -->
        <div class="mb-3">
            <label class="form-label">Bersedia Donasi?</label>
            <select name="bersedia_donasi" class="form-control" id="donasiSelect" required>
                <option value="">-- Pilih --</option>
                <option value="ya">Ya</option>
                <option value="tidak">Tidak</option>
            </select>
        </div>

        <!-- Jumlah Donasi (opsional) -->
        <div class="mb-3" id="jumlahDonasiDiv" style="display:none;">
            <label class="form-label">Jumlah Donasi</label>
            <input type="number" name="jumlah_donasi" class="form-control">
        </div>

        <!-- Bukti Transfer Donasi (opsional) -->
        <div class="mb-3" id="buktiDonasiDiv" style="display:none;">
            <label class="form-label">Bukti Transfer Donasi (jpg/png)</label>
            <input type="file" name="bukti_transfer_donasi" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Kirim</button>
        <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
    document.getElementById("donasiSelect").addEventListener("change", function() {
        if (this.value === "ya") {
            document.getElementById("jumlahDonasiDiv").style.display = "block";
            document.getElementById("buktiDonasiDiv").style.display = "block";
        } else {
            document.getElementById("jumlahDonasiDiv").style.display = "none";
            document.getElementById("buktiDonasiDiv").style.display = "none";
        }
    });
</script>
@endsection
