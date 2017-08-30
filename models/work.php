<?php

class Work
{
    public static function get()
    {
        $get = DB::getConnection()->prepare( "SELECT * FROM workplace" );
        $get->execute();
        return $get->fetchAll();
    }

    public static function create( $post, $date )
    {
        $indexes = array( 'workplace', 'from', 'to' );
        if( !check( $post, $indexes ) )
        {
            return false;
        }

        $post['from'] = strtotime( $date['year'] . '/' . $date['month'] . '/' . $date['day'] . ' ' . $post['from'] );
        $post['to'] = strtotime( $date['year'] . '/' . $date['month'] . '/' . $date['day'] . ' ' . $post['to'] );

        $insert = DB::getConnection()->prepare( "INSERT INTO work_times ( timestart, timestop, user_id, work_id, hours) VALUES ( :timestart, :timestop, :user_id, :work_id, :hours )" );
        $insert->execute( array(
            ':timestart' => $post['from'],
            ':timestop'  => $post['to'],
            ':user_id'   => $_SESSION['user_id'],
            ':work_id'   => $post['workplace'],
            ':hours'     => ( $post['to'] - $post['from'] ) / 3600
        ) );
    }
}

?>
