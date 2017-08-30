<?php
class WorkController
{
    public static function view( $year, $month, $day )
    {
        $date = $year . '/' . $month . '/' . $day;
        view( 'work/view', array(
            'workplace'     => Work::get(),
            'date'          => $date
        ) );
    }

    public static function createWorkTime( $year, $month, $day )
    {
        $date = array( 'year' => $year, 'month' => $month, 'day' => $day );
        if( !Work::create_time( $_POST, $date ) )
        {
            view( 'dashboard/main', array(
                'dayamount'     => Calendar::day_amount(),
                'startday'      => Calendar::start_day(),
                'weekamount'    => Calendar::week_amount(),
                'connector'     => Calendar::get_connector(),
                'month'         => Calendar::get_month(),
                'year'          => Calendar::get_year(),
                'error'         => 1,
                'message'       => 'Någonting gick fel'
            ) );
        }
        redirect('/');
    }
}
?>
