<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdBlockController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// homepage (you can point this to your newspaper frontend)
Route::get('/', function () {
    return view('frontend.home'); // or return view('frontend.home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Admin / CMS Routes
|--------------------------------------------------------------------------
| You can wrap these with middleware(['auth','can:...']) later.
*/


//Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('site-icons', [DashboardController::class, 'site_icons'])->name('siteicons');
    Route::get('post', [DashboardController::class, 'posts'])->name('adminposts'); 
    Route::get('categories', [DashboardController::class, 'categories'])->name('admincategories'); 
    Route::get('medias', [DashboardController::class, 'medias'])->name('adminmedias'); 
});

//dashboard



// Roles
Route::resource('roles', RoleController::class);

// Categories
Route::resource('categories', CategoryController::class);

// Media (image upload/list)
Route::resource('media', MediaController::class);

// Posts / News
Route::resource('posts', PostController::class);

// Tags
Route::resource('tags', TagController::class);

// Pages (About, Contact, Privacy)
Route::resource('pages', PageController::class);

// Menus
Route::resource('menus', MenuController::class);

// Menu items (nested under menus)
Route::prefix('menus/{menu}')->group(function () {
    Route::get('items/create', [MenuItemController::class, 'create'])->name('menu-items.create');
    Route::post('items', [MenuItemController::class, 'store'])->name('menu-items.store');
    Route::get('items/{menuItem}/edit', [MenuItemController::class, 'edit'])->name('menu-items.edit');
    Route::put('items/{menuItem}', [MenuItemController::class, 'update'])->name('menu-items.update');
    Route::delete('items/{menuItem}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');
});

// Settings (simple key-value)
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

// Comments (moderation + frontend submit)
Route::resource('comments', CommentController::class)->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

/*
|--------------------------------------------------------------------------
| Frontend display routes (optional but useful)
|--------------------------------------------------------------------------
| These are for your actual newspaper pages.
| You can move them to a separate route file later.
*/

// Single news by slug
Route::get('/news/{slug}', function ($slug) {
    $post = \App\Models\Post::where('slug', $slug)
        ->where('status', 'published')
        ->with(['author', 'category', 'comments'])
        ->firstOrFail();

    return view('frontend.post', compact('post'));
})->name('news.show');

// Static page by slug
Route::get('/page/{slug}', function ($slug) {
    $page = \App\Models\Page::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

    return view('frontend.page', compact('page'));
})->name('page.show');


//news by category slug
Route::get('category/{slug}', [PostController::class, 'categoryNews'])->name('categorywisenews');

//single news
Route::get('news/{slug}', [PostController::class, 'show'])->name('singleNews');

//ads route
Route::post('/ads/store', [AdBlockController::class, 'store'])->name('ads.store');

Route::get('videos', [DashboardController::class, 'video'])->name('videoss');


/*
|--------------------------------------------------------------------------
| Fallback (optional)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
