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
	return $request->server();
});

Auth::routes();

Route::prefix('admin')->namespace('Admin')->middleware(['web', 'admin'])->group(function ( Routes $route) {

	$route->get('/','IndexController@index')->name('admin.index');
	$route->resource('user','UserController')->names('admin.user');
	$route->resource('category','CategoryController')->names('admin.category');
	$route->resource('article','ArticleController')->names('admin.article');
	$route->resource('comment','CommentController')->names('admin.comment');
	$route->resource('link','LinkController')->names('admin.link');
	$route->resource('demo','DemoController')->names('admin.demo');
	
	
	$route->post('/upload','ArticleController@upload')->name('upload_md_image');
});





Route::namespace('Home')->group(function(Routes $route){
	$route->get('/article/{article}/','ArticleController@index')->name('article.index');
	
	$route->post('/article/{article}/comment/{comment?}','ArticleController@comment')->name('article.comment');
	$route->get('/', 'IndexController@index');
	$route->get('category/{article_category}', 'CategoryController@index')->name('category.index');
	$route->get('tags/{label}', 'TagsController@index')->name('tags.index');
	$route->get('search', 'SearchController@index')->name('search.index');
	
	$route->get('go-wild', 'IndexController@link')->name('go-wild');
	
	$route->post('/add-link', 'LinkController@store')->name('add.link');
	
	$route->get('feed', 'GeneratedController@feed')->name('feed');
	
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});

