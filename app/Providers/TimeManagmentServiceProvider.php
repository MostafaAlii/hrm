<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Services\CustomMonthService;
use App\Services\Contracts\CustomMonthInterface;
class TimeManagmentServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->singleton(CustomMonthInterface::class, function ($app) {
            return new CustomMonthService();
        });
    }

    public function boot(): void {
        //
    }
}
