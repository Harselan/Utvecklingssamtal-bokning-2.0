<?php
class Search
{
    public static function do( $post )
    {
        if( !check( $post, array( 'search' ) ) )
        {
            var_dump($post);die(hej);
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
        $get = DB::getConnection()->prepare( "SELECT users.name, work_times.* FROM users
                                INNER JOIN work_times ON work_times.user_id = users.id
                                WHERE users.name LIKE :index OR work_times.id LIKE :index" );
        $get->execute( array(
            ':index' => '%' . $post['search'] . '%'
        ) );

        return $get->fetchAll();
    }

    public static function get_users( $post )
    {
        $get = DB::getConnection()->prepare( "SELECT id, name FROM users WHERE name LIKE :index OR id LIKE :index" );
        $get->execute( array(
            ':index' => '%' . $post['search'] . '%'
        ) );

        return $get->fetchAll();
    }
}
?>
