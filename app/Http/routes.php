<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * This displays the welcome page.
 * If user is signed_in, you are re-directed to your homepage
 * @return \Illuminate\View\View
 */
Route::get('/', ['middleware' =>'guest', function(){
    return view('welcome');
}]);

Route::get('home', 'AccessController@home');

Route::get('admin', 'AdminController@index');
Route::get('admin/{id}/show', 'AdminController@show');
Route::get('admin/search/{queryString?}/{book_id?}',  ['as' => 'searchResults', 'uses' => 'AdminController@show_results']);
Route::get('admin/student', ['as' => 'searchStudent', 'uses' => 'AdminController@show_students']);
Route::get('admin/student_details', ['as' => 'student', 'uses' => 'AdminController@student_details']);
Route::post('admin/search', 'AdminController@search');
Route::get('admin/receive', 'AdminController@receive');
Route::post('admin/receive', 'AdminController@do_receive');
Route::get('admin/loan', 'AdminController@loan');
Route::post('admin/loan', 'AdminController@do_loan');
Route::get('admin/overdue', 'AdminController@overdue');
Route::get('admin/reserved', 'AdminController@reserved');
Route::get('admin/profile', 'AdminController@profile');
Route::post('admin/profile', 'AdminController@update_profile');
Route::get('admin/add', 'AdminController@add');
Route::post('admin/add', 'AdminController@store');
Route::get('admin/{id}/edit', 'AdminController@edit');
Route::post('admin/edit/{id}', 'AdminController@editbook');
Route::get('admin/update_reserve/{student_id}/{book_id}',  ['as' => 'updateReserve', 'uses' => 'AdminController@update_receive']);
Route::get('admin/update_loan/{student_id}/{book_id}',  ['as' => 'updateLoan', 'uses' => 'AdminController@update_loan']);


Route::get('student', 'StudentController@index');
Route::get('student/search/{book_id?}/{queryString?}',  ['as' => 'studentResults', 'uses' => 'StudentController@show_results']);
Route::post('student/search', 'StudentController@search');
Route::get('student/records', 'StudentController@records');
Route::get('student/profile', 'StudentController@profile');
Route::post('student/profile', 'StudentController@update_profile');
Route::get('student/{id}/show', 'StudentController@show_book');
Route::get('student/reserve/{id}', 'StudentController@reservation');

Route::controllers([
    'auth'=>'Auth\AuthController',
    'password'=>'Auth\PasswordController']);