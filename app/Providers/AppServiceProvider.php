<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use View;

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

        View::composer('admin.products.index', function ($view){
            $dir =  '/public/export/products';
            $view->with('productFiles', Storage::files($dir));
            $view->with('exportCategories', Category::pluck('name', 'id'));
        });
    }
}
