<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [HomeController::class, "home"])->name("home");

Route::get('/template', function() {
    return view('template');
});

Route::controller(UserController::class)->group(function() {
    Route::get('/login', 'login')->middleware(OnlyGuestMiddleware::class);
    Route::post('/login', 'doLogin')->middleware(OnlyGuestMiddleware::class);
    Route::post('/logout', 'doLogout')->middleware(OnlyMemberMiddleware::class);
});


Route::controller(TodolistController::class)->middleware(OnlyMemberMiddleware::class)->group(function() {
        Route::get("/todolist", "todolist");
        Route::post("/todolist", "tambahTodo");
        Route::post("/todolist/{id}/hapus", "hapusTodo");
});