<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [\App\Http\Controllers\ArticleController::class, 'dashboard'])->name('dashboard');

Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');
