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
        $get = DB::getConnection()->prepare( "SELECT id FROM users WHERE name = :name AND password = :password" );
        $get->execute( array(
            ':name'     => $post['name'],
            ':password' => $post['password']
        ) );
        $id = $get->fetchAll();
        if( $id > 0 )
        {
            $_SESSION['name'] = $post['name'];
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>
