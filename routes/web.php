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

Route::get('/', function () {
    return view('welcome');
});

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
Route::resource('products','ProductsController');
