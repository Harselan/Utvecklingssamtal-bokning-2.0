<?php

class ReportController
{
    function get_users()
    {
        view( 'reports/view', array(
            'reports' => Report::get_users()
        ) );
    }
}

?>
