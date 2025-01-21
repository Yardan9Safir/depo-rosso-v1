<?php

// use App\Http\Controllers\API\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return 'API';
});

// Route::apiResource('product', ItemController::class);
