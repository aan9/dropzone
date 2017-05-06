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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'ProductsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

// Route for State
Route::resource('states','StatesController');

// Route for Area
Route::resource('areas','AreasController');

// Route for Category
Route::resource('categories','CategoriesController');

// Route for Subcategory
Route::resource('subcategories','SubcategoriesController');

// Route for Brand
Route::resource('brands','BrandsController');

// Route for Listing type
Route::resource('listingtypes','ListingTypesController');

// Route for Product
Route::get('my_products', 'ProductsController@my_products')->name('my_products');

Route::get('products/areas/{state_id}', 'ProductsController@getStateAreas');
Route::get('products/subcategories/{category_id}', 'ProductsController@getCategorySubcategories');
Route::resource('products','ProductsController');

Route::resource('products.create','ProductsController');

//Route for admin manage product
Route::group(['prefix' => 'admin','as'=>'admin.'], function () {


	//Route for products
	Route::get('products/areas/{state_id}', 'Admin\AdminProductsController@getStateAreas');
	Route::get('products/subcategories/{category_id}', 'Admin\AdminProductsController@getCategorySubcategories');
	Route::resource('products','Admin\AdminProductsController');



});
