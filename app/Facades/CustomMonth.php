<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
use App\Services\Contracts\CustomMonthInterface;
class CustomMonth extends Facade {
    protected static function getFacadeAccessor() {
        return CustomMonthInterface::class;
    }
}
