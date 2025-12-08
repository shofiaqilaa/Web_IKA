<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->integer('tahun_lulus')->nullable();
            $table->string('metode_pengiriman_kta')->nullable();
            $table->integer('jumlah_kta')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('bukti_transfer_kta')->nullable();
            $table->string('bersedia_donasi')->nullable();
            $table->integer('jumlah_donasi')->nullable();
            $table->string('bukti_transfer_donasi')->nullable();
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
                'bukti_transfer_donasi',
            ]);
        });
    }
};
