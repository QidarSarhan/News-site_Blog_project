<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
// use Illuminate\Pagination\Paginator;


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
        //
        // Paginator::useBootstrap();
        $settings = Setting::checkSettings();
        $categories = Category::with('children')->where('parent' , 0)->orWhere('parent' , null)->get();
        $lastFivePosts = Post::with('category','user')->orderBy('id')->limit(5)->get();
        
        View()->share([
            'setting'=>$settings,
            'categories'=>$categories,
            'lastFivePosts'=>$lastFivePosts,
        ]);


    }
}
