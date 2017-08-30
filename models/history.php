<?php
class History
{
    public static function get( $date = 0 )
    {
        if( $date == 0 )
        {
            $get = DB::getConnection()->prepare( "SELECT work_times.id, work_times.hours, work_times.timestart, work_times.timestop, users.name, workplace.name AS work FROM work_times INNER JOIN users ON users.id = work_times.user_id INNER JOIN workplace ON workplace.id = work_times.work_id ORDER BY work_times.id DESC" );
            $get->execute();
        }
        else
        {
            $time = strtotime( $date );

            $get = DB::getConnection()->prepare( "SELECT work_times.id, work_times.hours, work_times.timestart, work_times.timestop, users.name, workplace.name AS work FROM work_times INNER JOIN users ON users.id = work_times.user_id INNER JOIN workplace ON workplace.id = work_times.work_id WHERE timestart BETWEEN :start AND :stop ORDER BY work_times.id DESC" );
            $get->execute( array(
                ':start' => $time,
                ':stop'  => $time + 86400
            ) );
        }
        
        return $get->fetchAll();

    }
}

?>
