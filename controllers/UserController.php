<?php
class UserController
{
    public function view( $id )
    {
        if( $id == $_SESSION['user_id'] || User::get( $_SESSION['user_id'] )['state_id'] == 2 )
        {
            view( '/user/view', array(
                'week_hour'     => Work::get_week_hours( $id ),
                'month_hour'    => Work::get_monthly_hours( $id ),
                'work_data'     => Work::get( $id ),
                'user'          => User::get( $id ),
                'states'        => User::get_states()
            ) );
        }
        else
        {
            redirect('/');
        }
    }

    public static function create()
    {
        view( 'user/create' );
    }

    public function changeState( $id )
    {
        if( !User::change_state( $id, $_POST ) )
        {
            view( '/user/view', array(
                'week_hour'     => Work::get_week_hours( $id ),
                'month_hour'    => Work::get_monthly_hours( $id ),
                'work_data'     => Work::get( $id ),
                'user'          => User::get( $id ),
                'states'        => User::get_states(),
                'error'         => 1,
                'message'       => 'Uppdateringen misslyckades!'
            ) );
        }
        else
        {
            view( '/user/view', array(
                'week_hour'     => Work::get_week_hours( $id ),
                'month_hour'    => Work::get_monthly_hours( $id ),
                'work_data'     => Work::get( $id ),
                'user'          => User::get( $id ),
                'states'        => User::get_states()
            ) );
        }
    }
}
?>
