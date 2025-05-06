<?php

use Illuminate\Support\Facades\Route;

/** GET routes */
Route::get('/', 'App\Http\Controllers\ComfyUiController@index')->name('comfyui');

/** POST routes */
Route::post('/comfyui_create', 'App\Http\Controllers\ComfyUiController@create')->name('comfyui.create');