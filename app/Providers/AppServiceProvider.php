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

        $view->with('sidebarTables', $tableNames);
    });
    }
}
