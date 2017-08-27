<?php
class DashboardController
{
    public function main()
    {
        view( 'dashboard/main', array(
            'users' => User::get_all()
        ) );
    }
}
?>
