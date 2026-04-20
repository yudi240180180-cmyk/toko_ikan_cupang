<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishController;

Route::get('/', [FishController::class, 'welcome']);
Route::resource('ikan', FishController::class);
