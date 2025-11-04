<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGambarToLokerTable extends Migration
{
    /**
     * Jalankan migrasi: tambahkan kolom gambar ke tabel loker.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loker', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('id_perusahaan');
        });
    }

    /**
     * Kembalikan migrasi: hapus kolom gambar.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loker', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
}
