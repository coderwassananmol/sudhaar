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

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth']],function (){
    Route::get('/document',function () {
        return view('document');
    })->name('document');
    Route::post('/document','hackController@addData');
    Route::get('/report',function () {
        return view('auth.report');
    })->name('report');
    Route::get('/generatepetition',function () {
        return view('auth.generatepetition');
    });
    Route::post('/generatepetition','hackController@printPDF');
    Route::post('/rate','hackController@addRate');
    Route::get('/checkRate','hackController@checkRate');
});
Route::post('/googlesignin','hackController@googleSignIn');
Route::get('/allcases',function (){
    return view('allcases');
});
Route::get('/allcases/search','hackController@filterCase');
Route::get('/getRate','hackController@getRate');
Route::get('/{language}','hackController@language')->name('language');
