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
            $category = Category::whereHas('movies', function ($query) {
                $query->where('status', 1);
            })->orderBy('title')->get();

            $genre = Genre::whereHas('movies', function ($query) {
                $query->where('status', 1);
            })->orderBy('title')->get();

            $country = Country::whereHas('movies', function ($query) {
                $query->where('status', 1);
            })->orderBy('title')->get();

            $view->with(compact('category', 'genre', 'country'));
        });
    }
}
