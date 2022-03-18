<?php

use Illuminate\Support\Facades\Route;

Route::get("/video_room/{hash_key}", "App\\Http\\Controllers\\TestController@video_room")->name("agora_room.welcome");
Route::get("/config_room", "App\\Http\\Controllers\\TestController@config_room")->name("agora_room.config_room");
Route::post("/encryption", "App\\Http\\Controllers\\TestController@hash_create")->name("agora_room.hash_create");
Route::get("/hash_key", "App\\Http\\Controllers\\TestController@hash_key")->name("agora_room.hash_key");


Route::prefix('admin')->group(function () {
    Route::get("/", "App\\Http\\Controllers\\AdminController@index")->name("admin.index");
    Route::get("/create_channel", "App\\Http\\Controllers\\AdminController@create_channel")->name("admin.create_channel");
    Route::post("/store_channel", "App\\Http\\Controllers\\AdminController@store_channel")->name("admin.store_channel");
    Route::get("/remove_channel", "App\\Http\\Controllers\\AdminController@remove_channel")->name("admin.remove_channel");
    Route::post("/delete_channel", "App\\Http\\Controllers\\AdminController@delete_channel")->name("admin.delete_channel");
    Route::get("/channel_status", "App\\Http\\Controllers\\AdminController@channel_status")->name("admin.channel_status");
});
