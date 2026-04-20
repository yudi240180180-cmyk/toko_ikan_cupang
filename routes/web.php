<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishController;

Route::get('/', function () {
    return redirect('/ikan');
});
Route::resource('ikan', FishController::class);
