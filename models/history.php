<?php
class History
{
    public static function get( $date = 0 )
    {
        if( $date == 0 )
        {
            $get = DB::getConnection()->prepare( "SELECT history.*, users.name AS name FROM history
                        INNER JOIN users ON users.id = history.user_id ORDER BY history.id DESC" );
            $get->execute();
        }
        else
        {
            $time = strtotime( $date );

            $get = DB::getConnection()->prepare( "SELECT history.*, users.name AS name FROM history
                        INNER JOIN users ON users.id = history.user_id
                        WHERE history.timestamp BETWEEN :start AND :stop
                        ORDER BY history.id DESC" );
            $get->execute( array(
                ':start' => $time,
                ':stop'  => $time + 86400
            ) );
        }

        return $get->fetchAll();
    }

    public static function get_work( $date = 0 )
    {
            $get = DB::getConnection()->prepare( "SELECT work_history.id, work_history.work_id, work_history.timestart, work_history.timestop,
            work_history.history_id, work_history.timestamp, users.name AS name, users.id AS user_id,
            workplace.name AS workplace FROM work_history
            INNER JOIN users ON users.id = work_history.user_id
            INNER JOIN workplace ON work_history.work_place_id = workplace.id ORDER BY work_history.id DESC" );
            $get->execute();

            return $get->fetchAll();
    }

    public static function add( $post )
    {
        $indexes = array( 'message', 'type_id' );
        if( !check( $post, $indexes ) )
        {
            die( "Någonting gick fel med loggningen!" );
        }
        else
        {
            $insert = DB::getConnection()->prepare( "INSERT INTO history ( user_id, timestamp, message, type_id )
            VALUES ( :user_id, :start, :message, :type_id )" );
            $insert->execute( array(
                ':user_id' => $_SESSION['user_id'],
                ':start'   => time(),
                ':message' => $post['message'],
                ':type_id' => $post['type_id']
            ) );
        }
    }

    public static function add_work( $post )
    {
        $indexes = array( 'work_id', 'history_id', 'work_place_id', 'timestart', 'timestop' );
        if( !check( $post, $indexes ) )
        {
            die( "Någonting gick fel med loggningen!" );
        }
        else
        {
            $insert = DB::getConnection()->prepare( "INSERT INTO work_history ( user_id, work_id, history_id, work_place_id, timestart, timestop, timestamp )
            VALUES ( :user_id, :work_id, :history_id, :work_place_id, :timestart, :timestop, :start )" );
            $insert->execute( array(
                ':user_id'       => $_SESSION['user_id'],
                ':work_id'       => $post['work_id'],
                ':history_id'    => $post['history_id'],
                ':work_place_id' => $post['work_place_id'],
                ':timestart'     => $post['timestart'],
                ':timestop'      => $post['timestop'],
                ':start'         => time()
            ) );
        }
    }
}

?>
