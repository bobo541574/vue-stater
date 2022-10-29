<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/users", [UserController::class, 'index']);

// Route::middleware(['auth:user-api', 'scopes:user'])->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware(['auth:customer-api', 'scopes:customer'])->get('/customer', function (Request $request) {
//     return "customer";
// });

// Route::post("/login/user", [LoginController::class, "login"]);
// Route::post("/login/customer", [LoginController::class, "customerLogin"]);
