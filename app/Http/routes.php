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

Route::get('/', 'HomeController@index');

Route::auth();
Route::get('/home', function () {
    return view('welcome');
});


Route::get('/html/','LessonController@indexHtml');
Route::get('/css/','LessonController@indexCss');

Route::get('/about/','AboutPageController@index');

Route::group(['middleware' => 'auth'], function()
{
	Route::get('/html/{lesson}',['as'=>'viewLesson','uses' =>'LessonController@reviewLesson']);
	Route::get('/html/task/{test}',['as'=>'viewTask','uses' =>'LessonController@reviewTask']);
	Route::post('/html/task/upload',['as'=> 'testAnswer', 'uses' => 'LessonController@check']);
	Route::get('/cabinet/','CabinetController@index');
});
