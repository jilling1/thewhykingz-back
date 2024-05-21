<?php

use App\Http\Controllers\NewsItemController;
use Illuminate\Support\Facades\Route;


Route::patch('/news/{id}/status', [NewsItemController::class, 'changeStatus']);
Route::apiResource('/news', NewsItemController::class);
