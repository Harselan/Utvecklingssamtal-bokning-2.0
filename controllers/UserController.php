<?php
class UserController
{
    public function view()
    {
        view( '/user/view', array(
            'week_hour'     => Work::get_week_hours(),
            'month_hour'    => Work::get_monthly_hours(),
            'work_data'     => Work::get( $_SESSION['user_id'] )
        ) );
    }
}
?>
