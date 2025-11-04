<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loker', function (Blueprint $table) {
            $table->id('id_loker');
            $table->string('judul_loker', 255);
            $table->text('deskripsi_loker');
            $table->unsignedBigInteger('id_perusahaan'); // relasi ke master_perusahaan
            $table->timestamps();

            // foreign key ke tabel master_perusahaan
            $table->foreign('id_perusahaan')
                  ->references('id_perusahaan')
                  ->on('master_perusahaan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loker');
    }
}
