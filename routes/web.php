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
    return view('welcome');
});

Route::get('/signup',"App\Http\Controllers\RegisterController@show");
Route::post('/signup',"App\Http\Controllers\RegisterController@do_register");
Route::get('/register/email/{query}', "App\Http\Controllers\RegisterController@checkEmail");
Route::get("/register/username/{q}", "App\Http\Controllers\RegisterController@checkUsername");

Route::get('/login',"App\Http\Controllers\LoginController@show");
Route::post('/login',"App\Http\Controllers\LoginController@do_login");
Route::get('/logout',"App\Http\Controllers\LoginController@logout");

Route::get('/homepage',"App\Http\Controllers\HomeController@show");
Route::get('/fetch_posts',"App\Http\Controllers\HomeController@fetch_posts");
Route::post('/like_post',"App\Http\Controllers\HomeController@like_post");
Route::post('/unlike_post',"App\Http\Controllers\HomeController@unlike_post");
Route::post('/fetch_send_comments',"App\Http\Controllers\HomeController@fetch_send_comments");
Route::post('/delete_post',"App\Http\Controllers\HomeController@delete_post");

Route::get('/create',"App\Http\Controllers\CreateController@show");
Route::post('/insert_post',"App\Http\Controllers\CreateController@insert_post");

Route::get('/search',"App\Http\Controllers\SearchController@show");
Route::get('/search/{title}',"App\Http\Controllers\SearchController@search");
Route::post('/add_favorites',"App\Http\Controllers\SearchController@add_favorites");

Route::get('/favorites',"App\Http\Controllers\FavoritesController@show");
Route::post('/remove_favorites',"App\Http\Controllers\FavoritesController@remove_favorites");
Route::get('/fetch_favorites',"App\Http\Controllers\FavoritesController@fetch_favorites");





Route::get('/prova',"App\Http\Controllers\HomeController@prova");

