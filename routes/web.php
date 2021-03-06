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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('channels', 'ChannelController')->only(['show', 'update']);

Route::get('/videos/{video}', 'VideoController@show')->name('video.show');

Route::group([
    'middleware' => ['web', 'auth']
], function() {
    Route::resource('channels/{channel}/subscriptions', 'SubscriptionController')->only(['store', 'destroy'])->middleware('auth');
    Route::get('channels/{channel}/videos', 'VideoController@upload')->name('channels.upload');
    Route::post('channels/{channel}/videos', 'VideoController@store')->name('videos.store');
});

