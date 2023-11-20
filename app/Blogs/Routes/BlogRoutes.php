<?php

use App\Http\Controllers\{
    ArticleController,
    CommentController,
    CategoryController
};
use Illuminate\Support\Facades\Route;


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
        Route::get('/admin', [CommentController::class, 'admin']);
        Route::get('/public', [CommentController::class, 'public']);
        Route::get('/select', [CommentController::class, 'select']);
        Route::get('/show/{article}', [CommentController::class, 'show']);
        Route::get('/edit/{article}', [CommentController::class, 'edit']);
        Route::put('/update/{article}', [CommentController::class, 'update']);
        Route::post('/store', [CommentController::class, 'store']);
        Route::patch('/visible/{article}', [CommentController::class, 'visible']);
        Route::delete('/destroy/{article}', [CommentController::class, 'destroy']);
    });
});


