<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            // Hapus kolom lama yang sudah tidak dipakai
            $table->dropColumn([
                'nama_alumni',
                'nomor_kta',
                'tahun_lulus',
                'jurusan_alumni',
                'prodi_alumni',
                'username',
                'password'
            ]);

            // Tambah kolom baru sesuai form baru
            $table->string('nama_lengkap');
            $table->string('angkatan');
            $table->string('jurusan');
            $table->string('no_wa');
            $table->text('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            // Jika rollback, tambahkan kembali kolom lama (opsional)
        });
    }
};
