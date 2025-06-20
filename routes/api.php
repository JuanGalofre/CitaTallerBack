<?php

use App\Http\Controllers\api\CitasController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);
Route::apiResource('citas',CitasController::class);
Route::get('/ping', fn () => response()->json(['pong' => true]));

