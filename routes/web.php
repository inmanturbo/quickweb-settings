<?php


if (config('dotenveditor.activated')) {
    Route::group(
        config('dotenveditor.route'),
        function () {
            Route::get('/', 'EnvController@overview')->name('index');
            Route::post('/add', 'EnvController@add')->name('add');
            Route::post('/update', 'EnvController@update')->name('update');
            Route::get('/getdetails/{timestamp?}', 'EnvController@getDetails')->name('getdetails');
        }
    );
}

if (config('settingseditor.activated')) {
    Route::group(
        config('settingseditor.route'),
        function () {
            Route::get('/', 'SettingsController@overview')->name('index');
            Route::post('/add', 'SettingsController@add')->name('add');
            Route::post('/update', 'SettingsController@update')->name('update');
            Route::get('/deletebackup/{timestamp}', 'SettingsController@deleteBackup')->name('deletebackup');
            Route::get('/getdetails/{timestamp?}', 'SettingsController@getDetails')->name('getdetails');
        }
    );
}
