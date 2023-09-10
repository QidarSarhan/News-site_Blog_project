<?php

use App\Http\Controllers\Dashboard\CategoryController as DashboardCategoryController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Website */


Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');




/* Route::get('/', function () {

    return app()->getLocale();
    // return config('app.locale');
    // return view('dashboard.index');
    // return view('dashboard.layouts.layout');
    // return view('welcome');
}); */

/* 
Route::prefix('dashboard')->group(function () {
    Route::get('/settings', function () {
        // echo 'settings';
        return view('dashboard.settings');

    })->name('dashboard.settings');
});
 */



 /* Dashboard */

Route::group(['prefix'=>'dashboard', 'as'=>'dashboard.', 'middleware'=>['auth', 'checkLogin']], function(){
    
    Route::get('/', function () {
        return view('dashboard.layouts.layout');
    })->name('index');

    /*  // Route::get('/settings', function () {
        //     return view('dashboard.settings');
        // })->name('settings');
    */
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    Route::post('/settings/update{setting}',[SettingController::class, 'update'])->name('settings.update');

    Route::get('/users/all', [UserController::class, 'getUsersDatatable'])->name('users.all');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');


    Route::get('/category/all', [DashboardCategoryController::class, 'getCategoriesDatatable'])->name('category.all');
    Route::post('/category/delete', [DashboardCategoryController::class, 'delete'])->name('category.delete');
    

    Route::get('/posts/all', [PostsController::class, 'getPostsDatatable'])->name('posts.all');
    Route::post('/posts/delete', [PostsController::class, 'delete'])->name('posts.delete');

    // Route::resource('users', UserController::class);
    Route::resources([
        'users' => UserController::class,
        'category' => \App\Http\Controllers\Dashboard\CategoryController::class,
        'posts' => PostsController::class,
        // '' => ::class,

    ]);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


