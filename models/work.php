<?php

class Work
{
    public static function get( $user_id = 0 )
    {
        if( $user_id == 0 )
        {
            $get = DB::getConnection()->prepare( "SELECT * FROM workplace" );
            $get->execute();
        }
        else
        {
            $get = DB::getConnection()->prepare( "SELECT work_times.id, ROUND( ( work_times.timestop - work_times.timestart ) / 3600 ) AS hours, work_times.timestart, work_times.timestop, workplace.name AS work FROM work_times
            INNER JOIN users ON users.id = work_times.user_id
            INNER JOIN workplace ON workplace.id = work_times.work_id
            WHERE user_id = :user_id ORDER BY work_times.id DESC" );
            $get->execute( array(
                ':user_id'  => $user_id
            ) );
        }

        return $get->fetchAll();
    }

    public static function get_work( $work_id )
    {
        $get = DB::getConnection()->prepare( "SELECT work_times.id, work_times.timestart, work_times.timestop, workplace.name AS work FROM work_times INNER JOIN users ON users.id = work_times.user_id INNER JOIN workplace ON workplace.id = work_times.work_id WHERE work_times.id = :id LIMIT 1" );
        $get->execute( array(
            ':id' => $work_id
        ) );
        return $get->fetchAll()[0];
    }

    public static function get_week_hours( $user_id = 0 )
    {
        if( $user_id == 0 )
        {
            $user_id = $_SESSION['user_id'];
        }
        $now = time();
        $beginning = strtotime( 'last Monday', $now );
        $end = strtotime( 'next Sunday', $now ) + 86400;

        $get = DB::getConnection()->prepare( "SELECT ROUND( SUM( timestop - timestart ) / 3600 ) AS workhours FROM work_times WHERE timestart BETWEEN :start AND :stop" );
        $get->execute( array(
            ':start'    => $beginning,
            ':stop'     => $end
        ) );

        return $get->fetchAll();
    }

    public static function get_monthly_hours( $user_id = 0 )
    {
        if( $user_id == 0 )
        {
            $user_id = $_SESSION['user_id'];
        }
        $now = time();
        $beginning = mktime( 0, 0, 0, date( "n" ), 1 );
        $end = mktime( 23, 59, 59, date( "n" ), date("t") );

        $get = DB::getConnection()->prepare( "SELECT ROUND( SUM( timestop - timestart ) / 3600 ) AS workhours FROM work_times WHERE timestart BETWEEN :start AND :stop" );
        $get->execute( array(
            ':start'    => $beginning,
            ':stop'     => $end
        ) );

        return $get->fetchAll();
    }

    public static function check_time( $time )
    {
        $time = explode( ':', $time );

        if( $time[0] > 24 || $time[0] < 0 || $time[1] > 59 || $time[1] < 0 )
        {
            die( "Tidpunkten var felaktig" );
        }

        return true;
    }

    public static function create( $post, $date )
    {
        $indexes = array( 'workplace', 'from', 'to' );
        if( !check( $post, $indexes ) )
        {
            return false;
        }

        self::check_time( $post['from'] );
        self::check_time( $post['to'] );

        $post['from'] = strtotime( $date['year'] . '/' . $date['month'] . '/' . $date['day'] . ' ' . $post['from'] );
        $post['to'] = strtotime( $date['year'] . '/' . $date['month'] . '/' . $date['day'] . ' ' . $post['to'] );

        $insert = DB::getConnection()->prepare( "INSERT INTO work_times ( timestart, timestop, user_id, work_id) VALUES ( :timestart, :timestop, :user_id, :work_id )" );
        $insert->execute( array(
            ':timestart' => $post['from'],
            ':timestop'  => $post['to'],
            ':user_id'   => $_SESSION['user_id'],
            ':work_id'   => $post['workplace']
        ) );
        $id = DB::getConnection()->lastInsertId();
        History::add( array( 'message' => $_SESSION['name'] . " har lagt till en arbetslogg den " . date( 'Y-m-d', $post['from'] ), 'type_id' => 2 ) );
        History::add_work( array( 'work_id' => $id, 'history_id' => DB::getConnection()->lastInsertId(), 'work_place_id' => $post['workplace'], 'timestart' => $post['from'], 'timestop' => $post['to']  ) );
    }

    public static function edit( $id, $post )
    {
        $indexes = array( 'workplace', 'from', 'to' );
        if( !check( $post, $indexes ) )
        {
            return false;
        }

        self::check_time( $post['from'] );
        self::check_time( $post['to'] );

        $get = DB::getConnection()->prepare( "UPDATE work_times SET work_id = :workplace, timestart = :start, timestop = :stop WHERE id = :id" );
        $get->execute( array(
            ':workplace'    => $post['workplace'],
            ':start'        => strtotime( $post['date'] . ' ' . $post['from'] ),
            ':stop'         => strtotime( $post['date'] . ' ' . $post['to'] ),
            ':id'           => $id
        ) );

        History::add( array( 'message' => $_SESSION['name'] . " har ändrat arbetstid  #" . $id, 'type_id' => 2 ) );
        History::add_work( array(
            'work_id'       => $id,
            'history_id'    => DB::getConnection()->lastInsertId(),
            'work_place_id' => $post['workplace'],
            'timestart'     => strtotime( $post['date'] . ' ' . $post['from'] ),
            'timestop'      => strtotime( $post['date'] . ' ' . $post['to'] )  ) );
        return true;
    }
}

?>
