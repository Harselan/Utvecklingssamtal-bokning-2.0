<?php

class Report
{
    static function get_users()
    {
        $get = DB::getConnection()->prepare( "SELECT users.name, (work_times.timestop - work_times.timestart)/3600 AS hours FROM users
                    INNER JOIN work_times ON work_times.user_id = users.id
                    WHERE work_times.timestart >= :start" );
        $get->execute( array(
            ':start' => strtotime( date( 'Y-m-01', time() ) )
        ) );

        return $get->fetchAll();
    }
}

?>
