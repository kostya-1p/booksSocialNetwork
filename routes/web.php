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

Route::get('profile/all', [\App\Http\Controllers\UserController::class, 'showAllUsers'])->
name('allProfiles');

Route::get('profile/{id}/comments', [\App\Http\Controllers\CommentController::class, 'showComments'])->
name('allUserComments')->whereNumber('id');

Route::get('profile/{id?}', [\App\Http\Controllers\UserController::class, 'showProfile'])->
name('dashboard')->whereNumber('id');

Route::get('profile/{id}/book/all', [\App\Http\Controllers\BookController::class, 'showBooks'])->
name('userBooks')->whereNumber('id')->middleware('books');

Route::get('profile/{user_id}/book/{book_id}', [\App\Http\Controllers\BookController::class, 'showBookById'])->
name('book')->whereNumber('user_id')->whereNumber('book_id')->middleware('book.link');

Route::get('profile/{user_id}/book/create', [\App\Http\Controllers\BookController::class, 'getUploadPage'])->
name('createBookPage')->whereNumber('user_id');

Route::get('profile/{user_id}/book/{book_id}/edit', [\App\Http\Controllers\BookController::class, 'getEditPage'])->
name('editBookPage')->whereNumber('user_id')->whereNumber('book_id');

Route::post('book/edit', [\App\Http\Controllers\BookController::class, 'edit'])->
name('editBook');

Route::post('book/delete', [\App\Http\Controllers\BookController::class, 'delete'])->
name('deleteBook');

Route::post('book/create', [\App\Http\Controllers\BookController::class, 'createBook'])->
name('createBook');

Route::post('upload', [\App\Http\Controllers\CommentController::class, 'upload'])->
name('upload');

Route::post('delete', [\App\Http\Controllers\CommentController::class, 'delete'])->
name('delete');

Route::get('/load_comments/{id}', [\App\Http\Controllers\UserController::class, 'loadRestComments'])->
whereNumber("id");

require __DIR__ . '/auth.php';
