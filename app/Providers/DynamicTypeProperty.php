<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ClassModel1;

class DynamicTypeProperty extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('typeproperty_array', ClassModel1::all());
        });
    }

}
