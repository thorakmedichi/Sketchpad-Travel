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
    return view('welcome');
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
Route::group([
	'prefix' => '/admin', 
    'as' => 'admin::',
    'middleware' => ['auth'] 
    ], function(){
	
		Route::get('/', function(){
			// Main dashboard landing page
		})->name('dashboard');

		Route::get('/author', 'AuthorController@index')->name('author');
});

