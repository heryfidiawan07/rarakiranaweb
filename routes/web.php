<?php

//Register verification
Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');

Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => 'admin'], function () {
		//Dashboard
		Route::get('/dashboard', 'DashboardController@dashboard');
		//Inbox
		Route::get('/dashboard/inbox', 'DashboardController@inbox');
		//Menu
		Route::get('/dashboard/menus', 'MenuController@index');
		Route::post('/menu/store', 'MenuController@store');
		Route::post('/menu/update/{id}', 'MenuController@update');
		Route::post('/menu/status/{id}', 'MenuController@status');
		Route::get('/menu/delete/{id}', 'MenuController@destroy');
		//Product Menu
		Route::post('/menu/product-store', 'MenuController@productStore');
		//Forum Menu
		Route::post('/menu/forum-store', 'MenuController@forumStore');
		//Articles
		Route::get('/dashboard/articles', 'ArticleController@index');
		Route::get('/article/create', 'ArticleController@create');
		Route::post('/article/store', 'ArticleController@store');
		Route::get('/article/{id}/edit', 'ArticleController@edit');
		Route::post('/article/{id}/update', 'ArticleController@update');
		Route::get('/article/{id}/destroy', 'ArticleController@destroy');
		Route::post('/article/status/{id}', 'ArticleController@status');
		Route::post('/article/acomment/{id}', 'ArticleController@acomment');
		//Product
		Route::get('/dashboard/products', 'ProductController@index');
		Route::get('/product/create', 'ProductController@create');
		Route::post('/product/store', 'ProductController@store');
		Route::get('/product/{id}/edit', 'ProductController@edit');
		Route::post('/product/{id}/update', 'ProductController@update');
		Route::get('/product/{id}/destroy', 'ProductController@destroy');
		Route::post('/product/status/{id}', 'ProductController@status');
		Route::post('/product/acomment/{id}', 'ProductController@acomment');
		//Gallery Destory
		Route::get('/product/gallery/{id}/destroy', 'GalleryController@destroy');
		//Category
		Route::post('/product/category/store', 'ProductController@categoryStore');
		Route::post('/product/category/{id}/update', 'ProductController@categoryUpdate');
		Route::post('/product/category/{id}/status', 'ProductController@categoryStatus');
		//Forum
		Route::get('/dashboard/forums', 'ForumController@index');
		Route::get('/forum/destroy/{id}', 'ForumController@destroy');
		Route::post('/forum/status/{id}', 'ForumController@status');
		//Tag
		Route::post('/forum/tag/store', 'ForumController@tagStore');
		Route::post('/forum/tag/{id}/update', 'ForumController@tagUpdate');
		Route::post('/forum/tag/{id}/status', 'ForumController@tagStatus');

});
//Global
Route::get('/{slugMenu}', 'GlobalController@menu');
//Article Show
Route::get('/read/article/{artslug}', 'ArticleController@show');
//Products
Route::get('/show/product/{prodslug}', 'ProductController@show');
Route::get('/products/category/{categorySlug}', 'ProductController@category');
//Forum User Auth
Route::group(['middleware' => 'auth'], function () {
	Route::get('/thread/create', 'ForumController@create');
	Route::post('/thread/store', 'ForumController@store');
	Route::get('/thread/edit/{slug}', 'ForumController@edit');
	Route::post('/thread/update/{slug}', 'ForumController@update');
});
//Forum
Route::get('/thread/{threadslug}', 'ForumController@show');
Route::get('/threads/tag/{tagSlug}', 'ForumController@tag');