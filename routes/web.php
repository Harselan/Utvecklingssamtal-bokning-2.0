<?php
if( User::logged_in() )
{
    Route::get('/', 'DashboardController@main');
}
else
{
    Route::get('/', 'LoginController@login');
    Route::post('/login', 'LoginController@doLogin');
}
?>
