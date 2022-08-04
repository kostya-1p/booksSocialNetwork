<?php

use Illuminate\Support\Facades\Route;

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

Route::get('profile/all', function () {
    echo 'List of all users';
});

Route::get('profile/{id?}', [\App\Http\Controllers\LoadProfileController::class, 'showProfile'])->
name('dashboard')->whereNumber('id');

Route::post('upload', [\App\Http\Controllers\UploadCommentController::class, 'upload'])->
name('upload');

Route::post('delete', [\App\Http\Controllers\DeleteCommentController::class, 'delete'])->
name('delete');

require __DIR__ . '/auth.php';
