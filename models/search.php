<?php
class Search
{
    public static function do( $post )
    {
        if( !check( $post, array( 'search' ) ) )
        {
            return false;
        }
        if( DateTime::createFromFormat( 'Y-m-d', $post['search'] ) || DateTime::createFromFormat( 'Y/m/d', $post['search'] ) )
        {
            $result = array(
                'works' => self::get_works( $post ),
                'users' => self::get_users( $post )
            );
        }
        else
        {
            $result = array(
                'works' => self::get_works( $post, 1 ),
                'users' => self::get_users( $post, 1 )
            );
        }


        return $result;
    }

    public static function get_works( $post, $val = 0 )
    {
        if( $val == 0 )
        {
            $post['search'] = strtotime( $post['search'] );
            $post['search'] += 7200;

            $get = DB::getConnection()->prepare( "SELECT work_history.id, work_history.work_id, work_history.timestart, work_history.timestop,
            work_history.history_id, work_history.timestamp, users.name AS name, users.id AS user_id,
            workplace.name AS workplace FROM work_history
            INNER JOIN users ON users.id = work_history.user_id
            INNER JOIN workplace ON work_history.work_place_id = workplace.id
                                    WHERE work_history.timestart > :start AND work_history.timestart < :stop ORDER BY work_history.work_id DESC" );
            $stop = $post['search'] + 86400;
            $get->execute( array(
                ':start' => $post['search'],
                ':stop'  => $stop
            ) );
        }
        else
        {
            $get = DB::getConnection()->prepare( "SELECT work_history.id, work_history.work_id, work_history.timestart, work_history.timestop,
            work_history.history_id, work_history.timestamp, users.name AS name, users.id AS user_id,
            workplace.name AS workplace FROM work_history
            INNER JOIN users ON users.id = work_history.user_id
            INNER JOIN workplace ON work_history.work_place_id = workplace.id
            WHERE users.name LIKE :index
            OR users.name LIKE :index
            OR work_history.work_id LIKE :index
            OR workplace.name LIKE :index ORDER BY work_history.work_id DESC" );
            $get->execute( array(
                ':index' => '%' . $post['search'] . '%'
            ) );
        }

        return $get->fetchAll();
    }

    public static function get_users( $post )
    {
        $get = DB::getConnection()->prepare( "SELECT id, name FROM users WHERE name LIKE :index OR id LIKE :index ORDER BY id DESC" );
        $get->execute( array(
            ':index' => '%' . $post['search'] . '%'
        ) );

        return $get->fetchAll();
    }
}
?>
