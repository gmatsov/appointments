<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'BookController@index')->name('/');

Route::get('book/create', 'BookController@create');

Route::get('book/edit/{id}', 'BookController@edit')->name('book.edit');

Route::get('book/{id}', 'BookController@show')->name('book.show');

Route::post('book/store', 'BookController@store')->name('book.store');

Route::delete('book/{id}', 'BookController@destroy')->name('book.destroy');

Route::put('book/{id}', 'BookController@update')->name('book.update');
