<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Illuminate\Routing\Router as Routes;
use Illuminate\Support\Facades\Storage;

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

Route::get('/t',function (\Illuminate\Http\Request $request){
	return $_SERVER;
});

Route::get('/h',function (\Illuminate\Http\Request $request){
	return $request->header();
});
Route::get('/ip',function (\Illuminate\Http\Request $request){
	dd($request);
});


Auth::routes();

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function ( Routes $route) {

	$route->get('/','IndexController@index')->name('admin.index');
	$route->resource('user','UserController');
	$route->resource('category','CategoryController');
	$route->resource('article','ArticleController');
	$route->resource('comment','CommentController');
	
	
	$route->post('/upload','ArticleController@upload')->name('upload_md_image');
});

Route::namespace('Home')->group(function(Routes $route){
	$route->get('/article/{article}/','ArticleController@index')->name('article.index');
	
	
	$route->post('/article/{article}/comment/{comment?}','ArticleController@comment')->name('article.comment');
	
	$route->get('/', 'IndexController@index');
	$route->get('category/{article_category}', 'CategoryController@index')->name('category.index');
	$route->get('tags/{label}', 'TagsController@index')->name('tags.index');
	$route->get('search', 'SearchController@index')->name('search.index');
});



