<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LandingController;


Route::get('/', [\App\Http\Controllers\LandingController::class, 'index']);
Route::get('/news/category/{slug}', [NewsController::class, 'category'])->name('news.category');

Route::get('/category/{slug}', [NewsController::class, 'category'])->name('category.show');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');


Route::get('/author/{username}', [AuthorController::class, 'show'])->name('author.show');

Route::get('/news', [NewsController::class, 'allnews'])->name('news.all');
Route::get('/search', [NewsController::class, 'search'])->name('news.search');