<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('events', function (Blueprint $table) {
    $table->id();
    $table->string('judul_event');
    $table->text('deskripsi_event');
    $table->date('tanggal_event');
    $table->string('gambar_event')->nullable();
    $table->timestamps();
});

}

public function down()
{
    Schema::dropIfExists('events');
}
}
