<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;


Route::resource('/question', QuestionController::class);
