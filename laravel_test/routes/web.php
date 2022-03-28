<?php

use Illuminate\Support\Facades\Route;

Route::get("/stream/{hash_key}", "App\\Http\\Controllers\\AgoraController@stream")->name("agora_room.stream");
Route::get("/index", "App\\Http\\Controllers\\AgoraController@index")->name("agora_room.index");
Route::post("/create", "App\\Http\\Controllers\\AgoraController@hash_create")->name("agora_room.hash_create");
Route::get("/display_hash", "App\\Http\\Controllers\\AgoraController@display_hash")->name("agora_room.display_hashkey");
Route::get("/channel_detail/{id}", "App\\Http\\Controllers\\AgoraController@channel_detail")->name("agora_room.channel_detail");
Route::get("/stand_by_room/{id}", "App\\Http\\Controllers\\AgoraController@stand_by_room")->name("agora_room.stand_by_room");
Route::get("/get_api/{channel_name}", "App\\Http\\Controllers\\AgoraController@get_api")->name("get_api");
Route::post("/chat_store", "App\\Http\\Controllers\\AgoraController@chat_store")->name("chat_store");
Route::post("/store_img", "App\\Http\\Controllers\\AgoraController@store_img")->name("store_img");


Route::prefix('admin')->group(function () {
    Route::get("/", "App\\Http\\Controllers\\AdminController@index")->name("admin.index");
    Route::get("/connect_stream/{id}", "App\\Http\\Controllers\\AdminController@connect_stream")->name("admin.connect_stream");
    Route::post("/create_channel", "App\\Http\\Controllers\\AdminController@create_channel")->name("admin.create_channel");
    Route::get("/remove_channel/{id}", "App\\Http\\Controllers\\AdminController@remove_channel")->name("admin.remove_channel");
    Route::get("/channel_status/{cname}", "App\\Http\\Controllers\\AdminController@channel_status")->name("admin.channel_status");
});
