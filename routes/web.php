<?php

use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}/{langId}', 'HomeController@lang');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('addLanguage', 'HomeController@addLanguage')->name('addLanguage');
Route::post('addKey', 'HomeController@addKey')->name('addKey');

Route::get('subtitle', 'HomeController@subtitle')->name('subtitle');
Route::post('addSubtitle', 'HomeController@addSubtitle')->name('addSubtitle');
Route::post('editSubtitle', 'HomeController@editSubtitle')->name('editSubtitle');

Route::get('next', 'HomeController@home')->name('home');
