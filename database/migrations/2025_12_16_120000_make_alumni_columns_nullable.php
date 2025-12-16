<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Note: Changing existing columns requires the doctrine/dbal package.
     */
    public function up()
    {
        if (!Schema::hasTable('alumni')) {
            return;
        }

        Schema::table('alumni', function (Blueprint $table) {
            // Make common fields nullable to avoid insert errors when form omits them.
            // These change() calls require doctrine/dbal.
            if (Schema::hasColumn('alumni', 'angkatan')) {
                $table->string('angkatan')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'alamat')) {
                $table->text('alamat')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'no_wa')) {
                $table->string('no_wa')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'metode_pengiriman_kta')) {
                $table->string('metode_pengiriman_kta')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'jumlah_kta')) {
                $table->integer('jumlah_kta')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'pas_foto')) {
                $table->string('pas_foto')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'bukti_transfer_kta')) {
                $table->string('bukti_transfer_kta')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'bersedia_donasi')) {
                $table->string('bersedia_donasi')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'jumlah_donasi')) {
                $table->integer('jumlah_donasi')->nullable()->change();
            }
            if (Schema::hasColumn('alumni', 'bukti_transfer_donasi')) {
                $table->string('bukti_transfer_donasi')->nullable()->change();
            }

            // Add timestamps if they don't exist (optional)
            if (!Schema::hasColumn('alumni', 'created_at') && !Schema::hasColumn('alumni', 'updated_at')) {
                $table->timestamps()->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (!Schema::hasTable('alumni')) {
            return;
        }

        Schema::table('alumni', function (Blueprint $table) {
            // We don't attempt to revert nullable changes to avoid accidental data loss.
            // You can manually reverse these if desired.
        });
    }
};
