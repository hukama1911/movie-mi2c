
<?php

use App\Models\Movie;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Middleware\RoleAdmin;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MovieController::class, 'homepage'])->name('homepage');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/create_movie', [MovieController::class, 'create'])->name('create_movie');
Route::post('/create_movie', [MovieController::class, 'store'])->name('store_movie');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// edit
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit')->middleware('auth', RoleAdmin::class);

// update
Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update')->middleware('auth', RoleAdmin::class);

// delete
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy')->middleware('auth');


Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');
