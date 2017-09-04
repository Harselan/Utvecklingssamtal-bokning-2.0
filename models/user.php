<?php
class User
{
    public static function get_all()
    {
        $get = DB::getConnection()->prepare("SELECT * FROM users");
        if( ! $get->execute() ) {
            die(var_export(DB::getConnection()->errorinfo(), TRUE));
        }
         return $get->fetchAll();
    }

    public static function logged_in()
    {
        if( empty( $_SESSION['name'] ) || !isset( $_SESSION['name'] ) )
        {
            return false;
        }

        return true;
    }

    public static function login( $post )
    {
        $get = DB::getConnection()->prepare( "SELECT id, password FROM users WHERE name = :name LIMIT 1" );
        $get->execute( array(
            ':name'     => $post['name']
        ) );
        $id = $get->fetchAll()[0];
        if( !isset( $id['id'] ) )
        {
            return false;
            die();
        }
        if( !password_verify( $post['password'], $id['password']  ) )
        {
            return false;
        }
        $_SESSION['name'] = $post['name'];
        $_SESSION['user_id'] = $id['id'];

        History::add( array( 'message' => $_SESSION['name'] . ' loggade in', 'type_id' => 1 ) );

        return true;
    }
}
?>
