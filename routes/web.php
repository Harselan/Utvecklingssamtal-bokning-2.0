<?php
if( User::logged_in() )
{
    if( $_SESSION['type'] == 2 )
    {
        Route::get('/history',                              'HistoryController@view');
        Route::get('/history/{page}',                       'HistoryController@view');

        Route::get('/workhistory',                          'HistoryController@viewWork');
        Route::get('/workhistory/{page}',                   'HistoryController@viewWork');

        Route::post('/search',                              'DashboardController@search');

        Route::get('/places',                               'WorkController@viewPlace');

        Route::get('/places/create',                        'WorkController@createPlace');
        Route::post('/places/create',                       'WorkController@doCreatePlace');

        Route::get('/place/{id}',                           'WorkController@viewPlace');

        Route::get('/place/{id}/change',                    'WorkController@changePlace');
        Route::post('/place/{id}/change',                   'WorkController@doChangePlace');

        Route::get('/place/{id}/delete',                    'WorkController@deletePlace');
    }
    Route::get('/',                                         'DashboardController@main');

    Route::get('/account/create',                           'UserController@create');
    Route::post('/account/create',                          'UserController@doCreate');


    Route::get('/account/{id}',                             'UserController@view');
    Route::post('/account/{id}/change',                     'UserController@changeState');

    Route::get('/date/{year}/{month}/{day}',                'WorkController@create');
    Route::post('/date/{year}/{month}/{day}/create',        'WorkController@doCreate');

    Route::get('/work/edit/{id}',                           'WorkController@edit');
    Route::post('/work/edit/{id}',                          'WorkController@doEdit');

    Route::get('/logout',                                   'LoginController@logout');

}
else
{
    Route::get('/',                                     'LoginController@login');
    Route::post('/login',                               'LoginController@doLogin');
}
?>
