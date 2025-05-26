
<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use GuzzleHttp\Promise\Create;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MovieController::class, 'homepage'])->name('homepage');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/create_movie', [MovieController::class, 'create'])->name('create_movie');
Route::post('/create_movie', [MovieController::class, 'store'])->name('create_movie');
