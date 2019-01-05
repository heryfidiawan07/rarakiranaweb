<?php

//Register verification
Route::get('/verify/{token}/{id}', 'Auth\RegisterController@verify_register');
//Social login google
Route::get('/auth/google', 'Auth\GoogleController@redirectToProvider');
Route::get('/auth/google/callback', 'Auth\GoogleController@handleProviderCallback');
//Social login facebook
Route::get('/auth/facebook', 'Auth\FacebookController@redirectToProvider');
Route::get('/auth/facebook/callback', 'Auth\FacebookController@handleProviderCallback');
//Social login twitter
Route::get('/auth/twitter', 'Auth\TwitterController@redirectToProvider');
Route::get('/auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback');

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
		Route::post('/article/sticky/{id}', 'ArticleController@sticky');
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
		Route::post('/product/sticky/{id}', 'ProductController@sticky');
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
		Route::post('/forum/sticky/{id}', 'ForumController@sticky');
		//Tag
		Route::post('/forum/tag/store', 'ForumController@tagStore');
		Route::post('/forum/tag/{id}/update', 'ForumController@tagUpdate');
		Route::post('/forum/tag/{id}/status', 'ForumController@tagStatus');
		//Logo
		Route::get('/dashboard/logo', 'LogoController@index');
		Route::post('/logo/store', 'LogoController@store');
		Route::post('/logo/update/{id}', 'LogoController@update');
		Route::get('/logo/delete/{id}', 'LogoController@destroy');
		//Follow
		Route::get('/dashboard/follow', 'FollowerController@index');
		Route::post('/follow/store', 'FollowerController@store');
		Route::post('/follow/update/{id}', 'FollowerController@update');
		Route::get('/follow/delete/{id}', 'FollowerController@destroy');
		//Share
		Route::get('/dashboard/share', 'ShareController@index');
		Route::post('/share/store', 'ShareController@store');
		Route::get('/share/delete/{id}', 'ShareController@destroy');
		//Promo
		Route::get('/dashboard/promo', 'PromoController@index');
		Route::post('/promo/store', 'PromoController@store');
		Route::post('/promo/update/{id}', 'PromoController@update');
		//Promo Picture
		Route::get('/promo/picture/delete/{id}', 'PromoController@deletePicture');
		//File Manager
    Route::get('/admin/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/admin/filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
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
	//Forum
	Route::get('/thread/create', 'ForumController@create');
	Route::post('/thread/store', 'ForumController@store');
	Route::get('/thread/edit/{slug}', 'ForumController@edit');
	Route::post('/thread/update/{slug}', 'ForumController@update');
	//Article Comment
	Route::post('/article/comment/{slug}/store', 'ArtcommentController@store');
	Route::post('/article/comment/{id}/update', 'ArtcommentController@update');
	//Product Discusion
	Route::post('/product/discus/{slug}/store', 'ProdcommentController@store');
	Route::post('/product/discus/{id}/update', 'ProdcommentController@update');
	//Forum Commment
	Route::post('/thread/comment/{slug}/store', 'ForcommentController@store');
	Route::post('/thread/comment/{id}/update', 'ForcommentController@update');
	//User
	Route::post('/user/image/upload/{id}', 'UserController@image');
	Route::post('/user/change/name/{id}', 'UserController@name');
	Route::post('/user/update/bio/{id}', 'UserController@bio');
});
//Forum
Route::get('/thread/{threadslug}', 'ForumController@show');
Route::get('/threads/tag/{tagSlug}', 'ForumController@tag');
//Search
Route::post('/search', 'SearchController@search');
//User Page
Route::get('/user/{slug}', 'UserController@show');
//Send Form Contact
Route::post('/send/message/contact', 'InboxController@contact');