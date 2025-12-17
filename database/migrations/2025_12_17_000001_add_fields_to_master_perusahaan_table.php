<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('master_perusahaan', function (Blueprint $table) {
            if (!Schema::hasColumn('master_perusahaan', 'logo')) {
                $table->string('logo')->nullable()->after('deskripsi_perusahaan');
            }
            if (!Schema::hasColumn('master_perusahaan', 'rating')) {
                $table->decimal('rating', 3, 1)->nullable()->after('logo');
            }
            if (!Schema::hasColumn('master_perusahaan', 'lokasi')) {
                $table->string('lokasi')->nullable()->after('rating');
            }
            if (!Schema::hasColumn('master_perusahaan', 'tentang_kami')) {
                $table->text('tentang_kami')->nullable()->after('lokasi');
            }
            if (!Schema::hasColumn('master_perusahaan', 'visi')) {
                $table->text('visi')->nullable()->after('tentang_kami');
            }
            if (!Schema::hasColumn('master_perusahaan', 'misi')) {
                $table->text('misi')->nullable()->after('visi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_perusahaan', function (Blueprint $table) {
            if (Schema::hasColumn('master_perusahaan', 'misi')) {
                $table->dropColumn('misi');
            }
            if (Schema::hasColumn('master_perusahaan', 'visi')) {
                $table->dropColumn('visi');
            }
            if (Schema::hasColumn('master_perusahaan', 'tentang_kami')) {
                $table->dropColumn('tentang_kami');
            }
            if (Schema::hasColumn('master_perusahaan', 'lokasi')) {
                $table->dropColumn('lokasi');
            }
            if (Schema::hasColumn('master_perusahaan', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('master_perusahaan', 'logo')) {
                $table->dropColumn('logo');
            }
        });
    }
};
