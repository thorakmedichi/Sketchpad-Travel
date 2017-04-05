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

		Route::resource('/post', 'PostController');
		Route::resource('/authors', 'AuthorController');
		Route::resource('/blogs', 'BlogController');
		Route::resource('/locations', 'LocationController');
		Route::resource('/trips', 'TripController');
		Route::resource('/maps', 'MapController');
		Route::resource('/images', 'ImageController');
		Route::resource('/tags', 'TagController');

});


/* --------------------------------------------
 * Ajax only routes
 * --------------------------------------------
 */
Route::prefix('/ajax')
	->as('ajax.')
	->middleware(['auth', 'ajax'])
	->group(function(){

	Route::post('s3/delete', 'FileController@deleteS3File')->name('dropzone.delete');

	Route::post('kml/upload', 'FileController@kmlUpload')->name('maps.dropzone.upload');
	Route::post('kml/delete', 'FileController@kmlDelete')->name('maps.dropzone.delete');

	Route::post('image/upload', 'FileController@imageUpload')->name('images.dropzone.upload');
	Route::post('image/delete', 'FileController@imageDelete')->name('images.dropzone.delete');
});


Route::get('/test-empty-response', function() { return ''; });