<?php
class DashboardController
{
    public function main()
    {
        // var_dump( User::get_all() );
        // die();
        $users = array(
            array(
                'name' => 'Harald',
                'pass' => 'pass'
            ),
            array(
                'name' => 'Herman',
                'pass' => 'herm'
            ),
            array(
                'name' => 'Pappa',
                'pass' => 'papp'
            )
        );
        // var_dump($users);die();
        view( 'dashboard/main', array(
            'users' => User::get_all()
        ) );
    }
}
?>
