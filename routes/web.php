<?php

use Illuminate\Support\Facades\Route;

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
    //return view('welcome');
    return redirect(route('home'));
});

//Route::get('/', 'HomeController@main')->name('main');
Auth::routes();

Route::get('/instagram', 'HomeController@instagram')->name('instagram');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/Leaderboard', 'HomeController@Leaderboard')->name('Leaderboard');
Route::get('/noLeaderboard', 'HomeController@noLeaderboard')->name('noLeaderboard');
Route::post('/latestMentionBoard', 'HomeController@latestMentionBoard')->name('latestMentionBoard');
Route::post('/addinstagram', 'HomeController@addinstagram')->name('addinstagram');
