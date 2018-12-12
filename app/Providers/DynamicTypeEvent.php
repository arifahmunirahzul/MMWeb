<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ClassModel2;

class DynamicTypeEvent extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('typeevent_array', ClassModel2::all());
        });
    }
}
