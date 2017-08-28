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
        $id = $get->fetchAll();
        if( $id <= 0 )
        {
            return false;
        }
        if( !password_verify( $post['password'], $id[0]['password']  ) )
        {
            return false;
        }
        $_SESSION['name'] = $post['name'];
        $_SESSION['user_id'] = $id[0]['id'];
        return true;
    }
}
?>
