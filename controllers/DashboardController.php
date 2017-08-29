<?php
class DashboardController
{
    public function main()
    {
        view( 'dashboard/main', array(
            'dayamount'     => Calendar::day_amount(),
            'startday'      => Calendar::start_day(),
            'weekamount'    => Calendar::week_amount(),
            'connector'     => Calendar::get_connector()
        ) );
    }
}
?>
