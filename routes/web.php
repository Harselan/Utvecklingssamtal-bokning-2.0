<?php
if( User::logged_in() )
{
    Route::get('/',         'DashboardController@main');
    Route::get('/account/{id}', 'UserController@view');

    Route::get('/logout',   'LoginController@logout');
}
else
{
    Route::get('/',         'LoginController@login');
    Route::post('/login',   'LoginController@doLogin');
}
?>
