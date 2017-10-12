<?php

class ReportController
{
    function get()
    {
        view( 'reports/views', array(
            'reports' => Report::get_users()
        ) );
    }

    function getUsers( $id )
    {
        view( 'reports/view', array(
            'reports' =>  Work::get_user_work( $id )
        ) );
    }
}

?>
