<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->integer('tahun_lulus')->nullable()->after('nama_lengkap');
            $table->string('metode_pengiriman_kta')->nullable()->after('jurusan');
            $table->integer('jumlah_kta')->nullable()->after('metode_pengiriman_kta');

            $table->string('pas_foto')->nullable()->after('jumlah_kta');
            $table->string('bukti_transfer_kta')->nullable()->after('pas_foto');

            $table->string('bersedia_donasi')->nullable()->after('bukti_transfer_kta');
            $table->integer('jumlah_donasi')->nullable()->after('bersedia_donasi');
            $table->string('bukti_transfer_donasi')->nullable()->after('jumlah_donasi');
        });
    }

    public function down()
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn([
                'tahun_lulus',
                'metode_pengiriman_kta',
                'jumlah_kta',
                'pas_foto',
                'bukti_transfer_kta',
                'bersedia_donasi',
                'jumlah_donasi',
                'bukti_transfer_donasi'
            ]);
        });
    }
};
