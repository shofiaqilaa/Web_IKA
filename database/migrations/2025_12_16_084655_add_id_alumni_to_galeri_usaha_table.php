<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->unsignedBigInteger('id_alumni')->nullable()->after('deskripsi');
            
            // Tambah foreign key (optional, tapi recommended)
            $table->foreign('id_alumni')
                  ->references('id')
                  ->on('alumni')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropForeign(['id_alumni']);
            $table->dropColumn('id_alumni');
        });
    }
};