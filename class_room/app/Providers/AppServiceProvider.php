<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Classwork;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        Relation::enforceMorphMap([
            'classwork' => Classwork::class,
            'post' => Post::class
        ]);
    }
}
