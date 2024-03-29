<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', 'PagesController@index');
Route::get('/homepage', 'PagesController@index');
Route::get('/signin', 'PagesController@signin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

/* Categories  */
Route::resource('users', 'UsersController');
Route::resource('categories', 'CategoriesController');
Route::resource('articles', 'ArticlesController');
Route::resource('lists', 'ListsController');
Route::post('/categories/store','CategoriesController@store');

Route::get('/ajax/getArticles', 'AjaxsController@getArticles');
Route::get('/ajax/getList', 'AjaxsController@getList');
Route::get('/ajax/crossFromList', 'AjaxsController@crossFromList');
Route::get('/ajax/removeFromList', 'AjaxsController@removeFromList');
Route::get('/ajax/getArticlesNotInList', 'AjaxsController@getArticlesNotInList');

