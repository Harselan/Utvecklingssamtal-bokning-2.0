<?php
class DashboardController
{
    public function main()
    {
        $time = time();
        view( 'dashboard/main', array(
            'daynumber' => cal_days_in_month( CAL_GREGORIAN, date( 'm', $time ), date( 'Y', $time ) ),
            'startday'  => Calendar::start_day()
        ) );
    }
}
?>
