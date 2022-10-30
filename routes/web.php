<?php

use App\Models\User;
use App\Models\Image;
use App\Services\ImageUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Http\Request;

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

Route::get("/", function () {
    return view('welcome');
});

Route::post('/upload', function (Request $request) {
    $image = ImageUpload::upload($request->file('file'), "test", User::class);
    $user = User::find(1);
    return $user->images()->create($image->toArray());
})->name('upload');

Route::get('users', [UserController::class, 'index']);

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
