<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    view()->composer('*', function ($view) {
        $tables = \DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE');
        $key = 'Tables_in_' . $dbName;
        $tableNames = array_map(fn($t) => $t->$key, $tables);

        // Filter tabel yang mau ditampilkan di sidebar
        $filteredTables = collect($tableNames)
            ->filter(function ($table) {
                // daftar tabel yang boleh tampil di sidebar
                return in_array($table, [
                    'alumni',
                    'loker',
                    'master_perusahaan', // tetap ambil tabel ini
                    'galeri',
                ]);
            })
            ->map(function ($table) {
                // tampilkan nama rapi di sidebar
                if ($table === 'master_perusahaan') {
                    return 'perusahaan'; // alias untuk tampil di sidebar
                }
                return $table;
            })
            ->values();

        $view->with('sidebarTables', $filteredTables);
    });
}
}
