<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvarticleer within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('articles', function () {
//     return Article::all();
// });
// Route::get('articles/{id}', function ($id) {
//     return Article::find($id);
// });
// Route::post('articles', function (Request $request) {
//     return Article::create($request->all());
// });
// Route::put('articles/{id}', function (Request $request, $id) {
//     $article = Article::findOrFail($id);
//     $article->update($request->all());
//     return $article;
// });
// Route::delete('articles/{id}', function ($id) {
//     Article::find($id)->delete();
//     return 204;
// });

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');
Route::get('articles', 'App\Http\Controllers\ArticleController@index');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('articles/{article}', 'App\Http\Controllers\ArticleController@show');
    Route::post('articles', 'App\Http\Controllers\ArticleController@store');
    Route::put('articles/{article}', 'App\Http\Controllers\ArticleController@update');
    Route::delete('articles/{article}', 'App\Http\Controllers\ArticleController@delete');

    // Articles
    Route::get('articles/{article}', 'App\Http\Controllers\ArticleController@show');
    Route::post('articles', 'App\Http\Controllers\ArticleController@store');
    Route::put('articles/{article}', 'App\Http\Controllers\ArticleController@update');
    Route::delete('articles/{article}', 'App\Http\Controllers\ArticleController@delete');

    // Comments
    Route::get('articles/{article}/comments', 'App\Http\Controllers\CommentController@index');
    Route::get('articles/{article}/comments/{comment}', 'App\Http\Controllers\CommentController@show');
    Route::post('articles/{article}/comments', 'App\Http\Controllers\CommentController@store');
    Route::put('articles/{article}/comments/{comment}', 'App\Http\Controllers\CommentController@update');
    Route::delete('articles/{article}/comments/{comment}', 'App\Http\Controllers\CommentController@delete');

});

/* Route::get('articles', 'App\Http\Controllers\ArticleController@index');
Route::get('articles/{article}', 'App\Http\Controllers\ArticleController@show');
Route::post('articles', 'App\Http\Controllers\ArticleController@store');
Route::put('articles/{article}', 'App\Http\Controllers\ArticleController@update');
Route::delete('articles/{article}', 'App\Http\Controllers\ArticleController@delete'); */
