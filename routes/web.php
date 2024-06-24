<?php
use App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SiteController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::post('login', [RegisterController::class, 'login'])->name('login.custom');

Route::get('login', [CustomAuthController::class, 'index'])->name('/');

Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('register.custom', [RegisterController::class, 'register'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard_page', function () {
        return view('dashboard_page');
    })->name('dashboard_page');
    
    
    Route::get('dashboard_member', function () {
        return view('dashboard_member');
    })->name('dashboard_member');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('profile2', function () {
        return view('profile2');
    })->name('profile2');

    Route::post('/profile/update', [RegisterController::class, 'updateProfile'])->name('profile.update');

    Route::get('post_site', function () {
        return view('post_site');
    })->name('post_site');
    
    Route::get('/register_admin', function () {
        return view('register_admin');
    });

    Route::get('/dashboard_page', [SiteController::class, 'index_dashb'])->name('dashboard_page');

    Route::get('/users/{id}/edit', [RegisterController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}', [RegisterController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [RegisterController::class, 'destroy'])->name('users.destroy');
    Route::get('/manage', [RegisterController::class, 'manage'])->name('manage');

    Route::patch('/profile/change-password', [RegisterController::class, 'changePassword'])->name('change.password');

    Route::get('/viewsites', [SiteController::class, 'index']);
    // Route::post('/site/images', [SiteController::class, 'fetchImages'])->name('site.images');
    Route::get('/view_processing/{site_id}', [SiteController::class, 'viewProcessing'])->name('view_processing');
    Route::delete('/sites/{site_id}', [SiteController::class, 'delete'])->name('delete_site');
    Route::get('/sites', [SiteController::class, 'index2'])->name('sites.index');
    Route::get('postimage', [SiteController::class, 'showPostImageForm'])->name('postimage');
    Route::post('postimage', [SiteController::class, 'postImage'])->name('postimage');
Route::get('/sites/create', [SiteController::class, 'create'])->name('sites.create');
Route::post('/sites', [SiteController::class, 'store'])->name('sites.store');
Route::get('virtual_sites', [SiteController::class, 'sites'])->name('virtual_sites');
    Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
    // Route::get('/virtual_sites', function () {
    //     return view('virtual_sites');
    // })->name('virtual_sites');



Route::get('image/{id}/edit', [SiteController::class, 'edit'])->name('image.edit');
Route::put('image/{id}', [SiteController::class, 'update'])->name('image.update');
Route::delete('image/{id}', [SiteController::class, 'destroy'])->name('image.destroy');
Route::get('image/{id}/confirm-delete', [SiteController::class, 'confirmDelete'])->name('image.confirm-delete');

    
    Route::get('/site/{id}/images', [SiteController::class, 'showImages'])->name('site.images');
});
