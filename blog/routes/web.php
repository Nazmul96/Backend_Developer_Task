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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['namespace'=>'App\Http\Controllers'],function(){
    Route::group(['prefix'=>'blog'],function(){
        Route::get('/', 'BlogController@index')->name('blog.index');
        Route::get('/create', 'BlogController@create')->name('create.blog');
        Route::post('/save', 'BlogController@save')->name('save.blog');
        Route::get('/edit/{id}', 'BlogController@edit')->name('edit.blog');
        Route::post('/update', 'BlogController@update')->name('update.blog');
        Route::get('/view/{id}', 'BlogController@view')->name('view.blog');
        Route::get('/delete/{id}', 'BlogController@delete')->name('delete.blog');

        Route::post('/comment', 'BlogController@comment')->name('blog.comment.save');
    });

    Route::get('/logout', 'BlogController@logout')->name('logout');
});
require __DIR__.'/auth.php';
