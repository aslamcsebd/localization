<?php

use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', 'HomeController@lang');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('addLanguage', 'HomeController@addLanguage')->name('addLanguage');
Route::post('addKey', 'HomeController@addKey')->name('addKey');
Route::post('addSubtitle', 'HomeController@addSubtitle')->name('addSubtitle');
Route::get('next', 'HomeController@home')->name('home');
