<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('ikan', FishController::class);
