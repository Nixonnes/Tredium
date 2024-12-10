<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::post('/articles/{slug}/increment-views', [ArticleController::class, 'incrementViews']);
Route::post('/articles/{slug}/increment-likes', [ArticleController::class, 'incrementLikes']);
Route::post('/comments', [CommentController::class, 'createComment']);
