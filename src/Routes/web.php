<?php

Route::group([
        'middleware' => ['web', 'laralum.base', 'laralum.auth'],
        'prefix' => config('laralum.settings.base_url'),
        'namespace' => 'Laralum\Users\Controllers',
        'as' => 'laralum::'
    ], function () {
        // First the suplementor, then the resource
        // https://laravel.com/docs/5.4/controllers#resource-controllers
        Route::get('users/{user}/delete', 'UserController@confirmDelete')->name('users.destroy.confirm');
        Route::resource('users', 'UserController', ['except' => ['show']]);
});
