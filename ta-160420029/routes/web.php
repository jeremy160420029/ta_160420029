<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController as AuthRegisterController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PythonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return view('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [AuthRegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthRegisterController::class, 'register'])->name('register.post');
Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
Route::get('/change_password', [ProfileController::class, 'showProfilePass'])->name('change_password');
Route::post('/profile/update_password', [ProfileController::class, 'changePassword'])->name('user.change_password');
Route::post('/profile/update_profile', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
Route::post('/profile/update_password', [ProfileController::class, 'changePassword'])->name('user.change_password');

Route::get('/verify', [AuthRegisterController::class, 'showVerificationForm'])->name('verify');
Route::middleware(['web'])->group(function () {
    Route::post('/verify', [AuthRegisterController::class, 'verify'])->name('done');
    Route::post('/update-email', [ProfileController::class, 'verify'])->name('profile.verify');
});

Route::resource("brands", BrandController::class);
Route::get('/brands/{id}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/search-brands', [BrandController::class, 'searchBrand'])->name('search.brand');

Route::resource("articles", ArticleController::class);
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/search-article', [ArticleController::class, 'searchArticle'])->name('search.article');
Route::get('/images/article/{id}', [ArticleController::class, 'image'])->name('images');

Route::resource("processes", ProcessController::class);
Route::get('/search-process', [ProcessController::class, 'searchProcess'])->name('search.process');

//pengecekan
Route::middleware(['can:is-user'])->group(function () {
    Route::get('/check/{id}', [PythonController::class, 'runRemoteScript'])->name('check');
    Route::resource("histories", HistoryController::class);
    Route::get('/search-history', [HistoryController::class, 'searchHistory'])->name('search.history');
});

Route::middleware(['can:is-admin'])->group(function () {
    Route::get('/admin/brand', [BrandController::class, 'indexadmin'])->name('admbrand.index');
    Route::get('/admin/brand/{id}', [BrandController::class, 'updateBrand']);
    Route::post('/admin/brand/update/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::post('/admin/delete_brand', [BrandController::class, 'deleteData'])->name('brands.deleteData');

    Route::get('/admin/article', [ArticleController::class, 'indexadmin'])->name('admarticle.index');
    Route::get('/admin/create_article', [ArticleController::class, 'create']);
    Route::get('/admin/edit_article/{article}', [ArticleController::class, 'adminedit']);
    Route::post('/admin/article/update/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::get('/admin/article/detail/{id}', [ArticleController::class, 'showAdm']);
    Route::post('/admin/delete_article', [ArticleController::class, 'deleteData'])->name('articles.deleteData');

    Route::post('/admin/create_image', [ImageController::class, 'store'])->name('images.store');
    Route::get('/admin/image/detail/{id}', [ImageController::class, 'showAdm']);
    Route::post('/admin/delete_image', [ImageController::class, 'deleteData'])->name('images.deleteData');

    Route::get('/admin/history', [HistoryController::class, 'indexadmin'])->name('admhistory.index');

    Route::get('/admin/user', [UserController::class, 'index'])->name('admuser.index');
    Route::post('/admin/create_admin', [UserController::class, 'store'])->name('admin.store');
    Route::post('/admin/delete_admin', [UserController::class, 'deleteDataAdm'])->name('user.deleteDataAdm');
    Route::post('/admin/delete_user', [UserController::class, 'deleteDataUsr'])->name('user.deleteDataUsr');
    Route::post('/admin/update_adm_staff/{id}', [UserController::class, 'updateAdmStaff'])->name('admin.updateAdmStaff');
    Route::get('/admin/update_admin/{id}', [UserController::class, 'updateAdm']);
    Route::get('/admin/add_admin/', [UserController::class, 'addAdmVerify'])->name('add.adm');
    Route::get('/admin/update_admin/', [UserController::class, 'updateAdmVerify'])->name('update.adm');

    Route::middleware(['web'])->group(function () {
        Route::post('/verify-update-admin', [UserController::class, 'verifyUpdtAdm'])->name('update.verify');
        Route::post('/verify-add-admin', [UserController::class, 'verify'])->name('add');
    });
});
