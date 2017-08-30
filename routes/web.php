<?php
if( User::logged_in() )
{
    Route::get('/',                                     'DashboardController@main');
    Route::get('/account/{id}',                         'UserController@view');

    Route::get('/date/{year}/{month}/{day}',            'WorkController@view');

    Route::get('/logout',                               'LoginController@logout');
    Route::post('/date/{year}/{month}/{day}/create',    'WorkController@createWorkTime');

    Route::get('/history',                              'HistoryController@view');
}
else
{
    Route::get('/',                                     'LoginController@login');
    Route::post('/login',                               'LoginController@doLogin');
}
?>
