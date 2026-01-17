<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function(){
    
    Route::get('/', function (Request $request) {
        return response()->json([
            "message"=>"Welcome to my admin"
        ]);
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

});
