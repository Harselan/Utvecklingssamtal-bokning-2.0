<?php
class DashboardController
{
    public function main()
    {
        view( 'dashboard/main', array(
            'dayamount'     => Calendar::day_amount(),
            'startday'      => Calendar::start_day(),
            'weekamount'    => Calendar::week_amount(),
            'connector'     => Calendar::get_connector(),
            'month'         => Calendar::get_month(),
            'year'          => Calendar::get_year(),
            'users'         => User::get(),
            'cuser'         => User::get( $_SESSION['user_id'] )['state_id']
        ) );
    }

    public function search()
    {
        view( 'search/view', array(
            'data'      => Search::do( $_POST ),
            'search'    => $_POST['search']
        ) );
    }
}
?>
