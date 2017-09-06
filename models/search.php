<?php
class Search
{
    public static function do( $post )
    {
        if( !check( $post, array( 'search' ) ) )
        {
            return false;
        }

        $result = array(
            'works' => self::get_works( $post ),
            'users' => self::get_users( $post )
        );
        return $result;
    }

    public static function get_works( $post )
    {
        $get = DB::getConnection()->prepare( "SELECT work_history.id, work_history.work_id, work_history.timestart, work_history.timestop,
        work_history.history_id, work_history.timestamp, users.name AS name, users.id AS user_id,
        workplace.name AS workplace FROM work_history
        INNER JOIN users ON users.id = work_history.user_id
        INNER JOIN workplace ON work_history.work_place_id = workplace.id
                                WHERE users.name LIKE :index OR work_history.work_id LIKE :index ORDER BY work_history.work_id DESC" );
        $get->execute( array(
            ':index' => '%' . $post['search'] . '%'
        ) );

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
