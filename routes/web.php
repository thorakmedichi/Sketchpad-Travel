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

/* --------------------------------------------
 * Landing page
 * --------------------------------------------
 */
Route::get('/', function () {
    return view('front.welcome');
})->name('home');


/* --------------------------------------------
 * Authentication routes
 * --------------------------------------------
 */
Auth::routes();

/* --------------------------------------------
 * Admin only routes
 * --------------------------------------------
 */
Route::prefix('/admin')
	->as('admin.')
	->middleware('auth')
	->group(function(){

		Route::name('dashboard')
			->get('/', function(){  });

		Route::resource('/authors', 'AuthorController');
		Route::resource('/blogs', 'BlogController');
		Route::resource('/locations', 'LocationController');
		Route::resource('/trips', 'TripController');

});
