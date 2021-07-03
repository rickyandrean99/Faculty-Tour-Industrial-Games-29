<?php

use Illuminate\Support\Facades\Route; 

Route::get('/', function () {
    return redirect()->route('loadTourPage');
});

Route::get('/tour/fakultas', 'TourController@loadTourPage')->name('loadTourPage');
Route::post('/selecttour', 'TourController@selectTourPage')->name('selectTourPage');