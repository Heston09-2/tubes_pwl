<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Artwork;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Menyediakan data artworks untuk semua view
        View::composer([  'layouts.app'], function ($view) {
            $artworks = Artwork::all();
            $view->with('artworks', $artworks);
        });
    }
}
