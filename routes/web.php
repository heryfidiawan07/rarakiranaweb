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
		Route::post('/menu/update/setting/{id}', 'MenuController@updateSetting');
		Route::post('/menu/update/name/{id}', 'MenuController@updateName');
		Route::post('/menu/status/{id}', 'MenuController@status');
		Route::get('/menu/delete/{id}', 'MenuController@destroy');
		//Product Menu
		Route::post('/menu/product-store', 'MenuController@productStore');
		//thread Menu
		Route::post('/menu/thread-store', 'MenuController@threadStore');
		//posts
		Route::get('/dashboard/posts', 'PostController@index');
		Route::get('/post/create', 'PostController@create');
		Route::post('/post/store', 'PostController@store');
		Route::get('/post/{id}/edit', 'PostController@edit');
		Route::post('/post/parent/{id}', 'PostController@parent');
		Route::post('/post/{id}/update', 'PostController@update');
		Route::get('/post/{id}/destroy', 'PostController@destroy');
		Route::post('/post/status/{id}', 'PostController@status');
		Route::post('/post/sticky/{id}', 'PostController@sticky');
		Route::post('/post/acomment/{id}', 'PostController@acomment');
		//etalase
		Route::post('/etalase/store', 'StorefrontController@store');
		Route::post('/etalase/update/name/{id}', 'StorefrontController@name');
		Route::post('/etalase/update/parent/{id}', 'StorefrontController@parent');
		Route::post('/etalase/{id}/update', 'StorefrontController@update');
		Route::post('/etalase/{id}/status', 'StorefrontController@status');
		Route::get('/etalase/delete/{id}', 'StorefrontController@delete');
		//Product Activate
		Route::post('/activate/products', 'StorefrontController@activate');
		Route::post('/product/update/{id}', 'StorefrontController@productUpdate');
		Route::post('/product/update/status/{id}', 'StorefrontController@productStatus');
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
		Route::post('/product/parent/{id}', 'ProductController@parent');
		//Picture Destory
		Route::get('/product/pictures/{id}/destroy', 'PictureController@destroy');
		//Admin Address
		Route::post('/admin/address/store', 'AddressController@adminAddress');
		//Order
		Route::get('/dashboard/orders', 'OrderController@index');
		Route::get('/dashboard/order-details/{order}', 'OrderController@details');
		Route::get('/proses/order/{order}', 'OrderController@orderProcesed');
		Route::get('/cancel/order/{order}', 'OrderController@orderRejected');
		Route::get('/order/print/invoice/{order}', 'OrderController@invoicePrint');
		Route::get('/order/print/delivery/{order}', 'OrderController@deliveryPrint');
		Route::post('/order/input/resi/{order}', 'OrderController@inputResi');
		Route::get('/done/order/{order}', 'OrderController@done');
		//Rekening
		Route::get('/dashboard/bank-accounts', 'RekeningController@index');
		Route::post('/bank-accounts/store', 'RekeningController@store');
		Route::post('/bank-accounts/update/{id}', 'RekeningController@update');
		Route::get('/bank-accounts/delete/{id}', 'RekeningController@destroy');
		//Tag Activate Forum
		Route::post('/activate/forum', 'TagController@activate');
		Route::post('/forum/update/{id}', 'TagController@forumUpdate');
		Route::post('/forum/update/status/{id}', 'TagController@forumStatus');
		//Tag
		Route::post('/tag/store', 'TagController@store');
		Route::post('/tag/update/name/{id}', 'TagController@updateName');
		Route::post('/tag/update/parent/{id}', 'TagController@updateParent');
		Route::post('/tag/status/{id}', 'TagController@status');
		Route::get('/tag/delete/{id}', 'TagController@delete');
		//Thread Admin
		Route::get('/dashboard/forum', 'ThreadController@index');
		Route::get('/thread/destroy/{id}', 'ThreadController@destroy');
		Route::post('/thread/status/{id}', 'ThreadController@status');
		Route::post('/thread/sticky/{id}', 'ThreadController@sticky');
		//Logo
		Route::get('/dashboard/logo', 'LogoController@index');
		Route::post('/logo/store', 'LogoController@store');
		Route::post('/logo/update/{id}', 'LogoController@update');
		Route::get('/logo/delete/{id}', 'LogoController@destroy');
		//Follow
		Route::get('/dashboard/follow', 'FollowController@index');
		Route::post('/follow/store', 'FollowController@store');
		Route::post('/follow/update/{id}', 'FollowController@update');
		Route::get('/follow/delete/{id}', 'FollowController@destroy');
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
		//User
		Route::get('/dashboard/users', 'DashboardController@users');
		Route::post('/user/status/{id}', 'DashboardController@statusUsers');
		//Inbox
		Route::get('/dashboard/inbox', 'DashboardController@inbox');
		//File Manager
    Route::get('/admin/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/admin/filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
});
//thread User Auth
Route::group(['middleware' => 'auth'], function () {
	//thread
	Route::get('/thread/create', 'ThreadController@create');
	Route::post('/thread/store', 'ThreadController@store');
	Route::get('/thread/edit/{slug}', 'ThreadController@edit');
	Route::post('/thread/update/{slug}', 'ThreadController@update');
	//post Comment
	Route::post('/post/comment/{slug}/store', 'CommentController@postStore');
	Route::post('/post/comment/{id}/update', 'CommentController@postUpdate');
	//Product Discusion
	Route::post('/product/discus/{slug}/store', 'CommentController@productStore');
	Route::post('/product/discus/{id}/update', 'CommentController@productUpdate');
	//Product Message
	Route::post('/product/message/{slug}/store', 'MessageController@messageProductStore');
	Route::post('/product/message/{id}/update', 'MessageController@MessageProductUpdate');
	//thread Commment
	Route::post('/thread/comment/{slug}/store', 'CommentController@threadStore');
	Route::post('/thread/comment/{id}/update', 'CommentController@threadUpdate');
	//User
	Route::post('/user/image/upload/{id}', 'UserController@image');
	Route::post('/user/change/name/{id}', 'UserController@name');
	Route::post('/user/update/bio/{id}', 'UserController@bio');
	//Product Checkout
	Route::get('/product/checkout', 'ProductController@checkout');
	Route::post('/product/payment', 'ProductController@payment');
	//User Payment
	Route::get('/user/{slug}/payment/{order}', 'UserController@payment');
	Route::get('/user/{slug}/print/invoice/{order}', 'UserController@invoice');
	//Pemabayaran User
	Route::post('/user/{slug}/payment/order/{order}', 'PaymentController@userPayment');
});
//Post
Route::get('/{slugMenu}', 'PostController@menu');
Route::get('/read/post/{slug}', 'PostController@show');

//Products
Route::get('/all/{slug}', 'ProductController@products');
Route::get('/show/product/{prodslug}', 'ProductController@show');
Route::get('/products/{slug}', 'ProductController@storefront');
//Product Checkout
Route::get('/product/cart/{slug}', "ProductController@buy");
Route::get('/add-to-cart/{slug}', "ProductController@addToCart");
Route::post('/add-new-qty-cart/{slug}/{key}', "ProductController@newQty");
Route::post('/add-min-qty-cart/{slug}/{key}', "ProductController@minQty");
Route::get('/product/cart', 'ProductController@cart');
Route::get('/remove-cart/{slug}', "ProductController@removeCart");

//Ongkir
Route::post('/cek/ongkir/product/{slug}/{tujuan}/{kurir}', 'ProductController@ongkir');
Route::post('/get-services/{kabId}/{kurir}', 'ProductController@services');
Route::post('/get-ongkir-services/{kabId}/{kurir}/{key}', 'ProductController@costService');

//Forum / Thread
Route::get('/page/{slug}', 'ThreadController@threads');
Route::get('/threads/{slug}', 'ThreadController@tag');
Route::get('/thread/{threadslug}', 'ThreadController@show');

//Search
Route::post('/search', 'SearchController@search');

//User Page
Route::get('/user/{slug}', 'UserController@show');

//Send Form Contact
Route::post('/send/message/contact', 'QuestionController@contact');