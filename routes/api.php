<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// grouping the routes for applying the middleware
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('/users', UserController::class);
// });
// or
// Route::group([
//     'middleware' => 'auth:sanctum',
//     'prefix' => 'users',
//     'as' => 'users.',
//     'namespace' => 'App\Http\Controllers'
// ], function () {
//     Route::get('/', [UserController::class, 'index'])->name('index');
//     Route::get('/{id}', [UserController::class, 'show'])->name('show');
//     Route::post('/', [UserController::class, 'store'])->name('store');
//     Route::put('/{id}', [UserController::class, 'update'])->name('update');
//     Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
// });
Route::apiResource('/users', UserController::class);
Route::apiResource('/comments', CommentController::class);
Route::apiResource('/posts', PostController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
