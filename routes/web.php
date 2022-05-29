<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Frontpage;
use App\Http\Controllers\ContactUsFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('storage/{filename}', function ($filename) {
        $userid = session()->get('user')->id;
        return Storage::get($userid . '/' . $filename);
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' =>[
   'auth:sanctum',
   'verified' 
]], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pages', function () {
        return view('admin.pages');
    })->name('pages');

    Route::get('/navigation-menus', function () {
        return view('admin.navigation-menus');
    })->name('navigation-menus');

    Route::get('/blogs', function () {
        return view('admin.blogs');
    })->name('blogs');

    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('categories');

    Route::get('/gallery', function () {
        return view('admin.gallery');
    })->name('gallery');

    Route::get('/testimonials', function () {
        return view('admin.testimonials');
    })->name('testimonials');

});

// Route::get('/{urlslug}', Frontpage::class);
Route::get('/', Frontpage::class);

// Route::get('404', function () {

//     return view('404', [
//         'header' => 'Contact Us',
//     ]);
// });


Route::get('posts/', [PostController::class, 'index'])->name('home');

// pass a uri slug to route/view
Route::get('posts/{post:slug}', [PostController::class, 'show']);

// Route::get('contact-us/', function () {

//     return view('contact-us', [
//         'header' => 'Contact Us',
//     ]);
// });

Route::get('contact-us/', [ContactUsFormController::class, 'createForm']);
Route::post('contact-us/', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');

// Route::get('authors/{author:username}', function (User $author) {

//     return view('posts', [
//         'posts' => $author->posts,
//         'header' => $author->name,
//         'categories' => Category::all(),
//     ]);
// });