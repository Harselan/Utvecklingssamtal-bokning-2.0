<?php
class DashboardController
{
    public function main()
    {
        var_dump( User::get_all() );
        die();
        view( 'dashboard/main' );
    }
}
?>
