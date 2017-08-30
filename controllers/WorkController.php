<?php
class WorkController
{
    public static function create( $year, $month, $day )
    {
        $date = $year . '/' . $month . '/' . $day;
        view( 'work/create', array(
            'workplace'     => Work::get(),
            'date'          => $date
        ) );
    }

    public static function doCreate( $year, $month, $day )
    {
        $date = array( 'year' => $year, 'month' => $month, 'day' => $day );
        if( !Work::create( $_POST, $date ) )
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
