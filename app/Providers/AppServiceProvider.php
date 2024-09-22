<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('pages.*', function ($view) {
            $category = Category::orderBy('title')->where('status', 1)->get();
            $genre = Genre::orderBy('title')->where('status', 1)->get();
            $country = Country::orderBy('title')->where('status', 1)->get();

            $view->with(compact('category', 'genre', 'country'));
        });
    }
}
