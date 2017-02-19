<?php

Route::group([
        'middleware' => ['web', 'laralum.base', 'laralum.auth'],
        'prefix' => config('laralum.settings.base_url'),
        'namespace' => 'Laralum\Users\Controllers',
        'as' => 'laralum::'
    ], function () {
        Route::get('users/{user}/delete', 'UserController@confirmDelete')->name('users.destroy.confirm');
        Route::get('users/{user}/roles/manage', 'UserController@manageRoles')->name('users.roles.manage');
        Route::post('users/{user}/roles/manage', 'UserController@updateRoles');
        Route::resource('users', 'UserController');
});
