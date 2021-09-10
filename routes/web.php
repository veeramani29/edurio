<?php
use App\Http\Controllers\UserController;

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

Route::any('/', [UserController::class, 'show']);

Route::get('word-cloud', function () {
    return view('word-cloud');
});
Route::group(['prefix' => 'api/v0'], function () {

Route::get('questions_answers', [UserController::class, 'list']);
Route::get('list_given_answers', [UserController::class, 'list_set_of_answers']);
Route::get('return_data', [UserController::class, 'return_data']);
Route::get('open_data', [UserController::class, 'open_question']);
});
