<?php

use App\Http\Controllers\MemoController;
use App\Http\Controllers\MemobuttonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/getmemo', [MemoController::class,'index']);

Route::get('/showmemotitles',  [MemobuttonController::class,'index']);

Route::post('/creatememobutton',  [MemobuttonController::class,'postdata']);

Route::post('/addmemo',  [MemoController::class,'aaa']);

Route::post('/addmemouser',  [MemobuttonController::class,'adduser']);
