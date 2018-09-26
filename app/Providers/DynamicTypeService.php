<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ClassModel;

class DynamicTypeService extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('typeservice_array', ClassModel::all());
        });
    }

}


