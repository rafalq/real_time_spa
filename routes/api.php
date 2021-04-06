<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;


Route::resource('/question', QuestionController::class);
Route::resource('/category', CategoryController::class);
