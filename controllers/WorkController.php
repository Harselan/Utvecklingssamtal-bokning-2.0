<?php
class WorkController
{
    public function create( $year, $month, $day )
    {
        $date = $year . '/' . $month . '/' . $day;
        view( 'work/create', array(
            'workplace'     => Work::get(),
            'date'          => $date
        ) );
    }

    public function doCreate( $year, $month, $day )
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
        redirect( '/account/' . $_SESSION['user_id'] );
    }

    public function edit( $id )
    {
        view( 'work/edit', array(
            'workplace' => Work::get(),
            'data'      => Work::get_work( $id )
        ) );
    }

    public function doEdit( $id )
    {
        if( !Work::edit( $id, $_POST ) )
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
        else
        {
            redirect( '/account/' . $_SESSION['user_id'] );
        }
    }
}
?>
