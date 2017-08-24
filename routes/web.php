<?php
Route::get('/', 'DashboardController@main');
Route::post('/login', 'LoginController@doLogin');
?>
