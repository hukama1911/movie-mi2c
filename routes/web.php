
<?php

use App\Models\Movie;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MovieController::class, 'homepage'])->name('homepage');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/create_movie', [MovieController::class, 'create'])->name('create_movie');
Route::post('/create_movie', [MovieController::class, 'store'])->name('create_movie');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
