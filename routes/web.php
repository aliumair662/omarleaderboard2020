<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
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

/*Route::get('/', function () {
    return redirect(route('home'));
});
Auth::routes();
Route::get('/instagram', 'HomeController@instagram')->name('instagram');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/Leaderboard', 'HomeController@Leaderboard')->name('Leaderboard');
Route::get('/noLeaderboard', 'HomeController@noLeaderboard')->name('noLeaderboard');
Route::post('/latestMentionBoard', 'HomeController@latestMentionBoard')->name('latestMentionBoard');
Route::post('/addinstagram', 'HomeController@addinstagram')->name('addinstagram');*/

/**/
Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setlocale'], function() {
    Route::get('/', function () {
        return redirect(route('home',app()->getLocale()));
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/instagram', 'HomeController@instagram')->name('instagram');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/Leaderboard', 'HomeController@Leaderboard')->name('Leaderboard');
    Route::get('/noLeaderboard', 'HomeController@noLeaderboard')->name('noLeaderboard');
    Route::post('/latestMentionBoard', 'HomeController@latestMentionBoard')->name('latestMentionBoard');
    Route::post('/addinstagram', 'HomeController@addinstagram')->name('addinstagram');
});