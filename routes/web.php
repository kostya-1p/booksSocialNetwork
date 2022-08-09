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

Route::get('/', function () {
    return redirect('profile/all');
});

Route::get('profile/all', [\App\Http\Controllers\ShowUserProfilesController::class, 'show'])->
name('allProfiles');

Route::get('profile/{id}/comments', [\App\Http\Controllers\ShowUserCommentsController::class, 'showComments'])->
name('allUserComments')->whereNumber('id');

Route::get('profile/{id?}', [\App\Http\Controllers\LoadProfileController::class, 'showProfile'])->
name('dashboard')->whereNumber('id');

Route::get('profile/{id}/book/all', [\App\Http\Controllers\ShowUserBooksController::class, 'showBooks'])->
name('userBooks')->whereNumber('id');

Route::post('upload', [\App\Http\Controllers\UploadCommentController::class, 'upload'])->
name('upload');

Route::post('delete', [\App\Http\Controllers\DeleteCommentController::class, 'delete'])->
name('delete');

Route::get('/load_comments/{id}', [\App\Http\Controllers\LoadProfileController::class, 'loadRestComments'])->
whereNumber("id");

require __DIR__ . '/auth.php';
