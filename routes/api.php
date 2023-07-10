<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    Route::prefix('/category')->group(function () {
        Route::get('/admin', [CategoryController::class, 'admin']);
        Route::get('/public', [CategoryController::class, 'public']);
        Route::get('/select', [CategoryController::class, 'select']);
        Route::get('/show/{category}', [CategoryController::class, 'show']);
        Route::get('/edit/{category}', [CategoryController::class, 'edit']);
        Route::put('/update/{category}', [CategoryController::class, 'update']);
        Route::post('/store', [CategoryController::class, 'store']);
        Route::delete('/destroy/{category}', [CategoryController::class, 'destroy']);
    });
    Route::prefix('/article')->group(function () {
        Route::get('/admin', [ArticleController::class, 'admin']);
        Route::get('/public', [ArticleController::class, 'public']);
        Route::get('/select', [ArticleController::class, 'select']);
        Route::get('/show/{article}', [ArticleController::class, 'show']);
        Route::get('/edit/{article}', [ArticleController::class, 'edit']);
        Route::put('/update/{article}', [ArticleController::class, 'update']);
        Route::post('/store', [ArticleController::class, 'store']);
        Route::delete('/destroy/{article}', [ArticleController::class, 'destroy']);
    });
    Route::prefix('/comment')->group(function () {
        Route::get('/admin', [CommentController::class, 'admin'])->withTrashed();
        Route::get('/public', [CommentController::class, 'public']);
        Route::get('/select', [CommentController::class, 'select']);
        Route::get('/show/{comment}', [CommentController::class, 'show']);
        Route::get('/edit/{comment}', [CommentController::class, 'edit']);
        Route::put('/update/{comment}', [CommentController::class, 'update']);
        Route::post('/store', [CommentController::class, 'store']);
        Route::delete('/destroy/{comment}', [CommentController::class, 'destroy'])->withTrashed();
    });
});
