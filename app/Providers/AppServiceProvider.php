<?php

namespace App\Providers;

use App\Models\Bill;
use App\Observers\BillObserver;
use Illuminate\Support\ServiceProvider;

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
        // CLASSE DE OBSERVAÇÃO ( CONTAS RECEBER )
        Bill::observe(BillObserver::class);
    }
}
