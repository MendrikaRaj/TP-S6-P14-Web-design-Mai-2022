<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
});
Route::get('/registration',[AuthController::class, 'registration'])->name('registration');
Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::get('/accueil',[AuthController::class, 'accueil'])->name('accueil');
Route::post('/logAdmin',[AuthController::class, 'logAdmin'])->name('logAdmin');
Route::post('/regAdmin',[AuthController::class, 'regAdmin'])->name('regAdmin');
Route::post('/posterArticle',[ArticleController::class, 'posterArticle'])->name('posterArticle');
Route::get('/infoDetail/{id}/{slug}',[ArticleController::class, 'infoDetail'])->name('infoDetail');
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::get('/liste',[AuthController::class, 'liste'])->name('liste');
Route::get('/poste',[AuthController::class, 'poste'])->name('poste');
