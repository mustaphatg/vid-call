<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get("/room", "RoomController@index");


// create room
Route::post("/create", "RoomController@create_room");

// join room
Route::get("/join/{name}", "RoomController@join_room")->name("join_room");


// send data
Route::post("post/send-data", "RoomController@send_data");



?>