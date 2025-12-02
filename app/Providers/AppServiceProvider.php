<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {

            // Ambil semua tabel dari database
            $dbName = env('DB_DATABASE');
            $tables = DB::select('SHOW TABLES');
            $key = 'Tables_in_' . $dbName;

            $tableNames = array_map(function ($table) use ($key) {
                return $table->$key;
            }, $tables);

            // Tabel yang boleh muncul di sidebar
            $allowedTables = [
                'alumni',
                'loker',
                'master_perusahaan',
                'galeri_usaha',
                'events'
            ];

            // Filter tabel lalu ubah nama tampilannya
            $filteredTables = collect($tableNames)
                ->filter(function ($table) use ($allowedTables) {
                    return in_array($table, $allowedTables);
                })
                ->map(function ($table) {

                    // alias master_perusahaan → perusahaan
                    if ($table === 'master_perusahaan') {
                        return 'perusahaan';
                    }

                    // alias events → event
                    if ($table === 'events') {
                        return 'event';
                    }

                    return $table;
                })
                ->values();

            // kirim ke semua view
            $view->with('sidebarTables', $filteredTables);
        });
    }
}