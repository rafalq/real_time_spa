<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/{any}', 'home');
Route::view('/{any}/{anything}', 'home');
