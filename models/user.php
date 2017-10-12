<?php
class User
{
    public static function get( $id = 0 )
    {
        if( $id == 0)
        {
            $get = DB::getConnection()->prepare("SELECT users.*, user_states.state FROM users INNER JOIN user_states ON users.state_id = user_states.id ORDER BY users.name ");
            if( ! $get->execute() ) {
                die(var_export(DB::getConnection()->errorinfo(), TRUE));
            }
            return $get->fetchAll();
        }
        else
        {
            $get = DB::getConnection()->prepare("SELECT users.*, user_states.state FROM users INNER JOIN user_states ON users.state_id = user_states.id WHERE users.id = :id LIMIT 1");
            if( ! $get->execute( array( ':id' => $id ) ) ) {
                die(var_export(DB::getConnection()->errorinfo(), TRUE));
            }
            return $get->fetchAll()[0];
        }
    }

    public static function create( $post )
    {
        if( !check( $post, array( 'name', 'password', 'state_id' ) ) )
        {
            return false;
        }

        $get = DB::getConnection()->prepare( "SELECT id FROM users WHERE name = :name LIMIT 1" );
        $get->execute( array(
            ':name' => $post['name']
        ) );

        if( $get->fetchAll() != null )
        {
            return false;
        }

        $post['password'] = password_hash( $post['password'], PASSWORD_DEFAULT );

        $insert = DB::getConnection()->prepare( "INSERT INTO users (name, password, state_id) VALUES (:name, :password, :state_id)" );
        $insert->execute( array(
            ':name'     => $post['name'],
            ':password' => $post['password'],
            ':state_id' => $post['state_id']
        ) );
        $id = DB::getConnection()->lastInsertId();
        History::add( array( 'message' => $_SESSION['name'] . " skapade ett nytt användarkonto som har användar_id #" . $id, 'type_id' => 2 ) );
        return $id;
    }

    public static function get_states()
    {
        $get = DB::getConnection()->prepare( "SELECT * FROM user_states" );
        $get->execute();

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

    public static function change_state( $user_id, $post )
    {
        if( !check( $post, array( 'state_id' ) ) )
        {
            return false;
        }
        $change = DB::getConnection()->prepare( "UPDATE users SET state_id = :state_id WHERE id = :id" );
        $change->execute( array(
            ':state_id' => $post['state_id'],
            ':id' => $user_id
        ) );

        $get = DB::getConnection()->prepare( "SELECT users.*, user_states.state FROM users INNER JOIN user_states ON user_states.id = users.state_id WHERE users.id = :user_id LIMIT 1" );
        $get->execute( array(
            ':user_id' => $user_id
        ) );

        $post = $get->fetchAll()[0];
        History::add( array( 'message' => $_SESSION['name'] . " har ändrat statusen för " . $post['name'] . ". Ny status är " . $post['state'], 'type_id' => 2 ) );
        return true;
    }

    public static function login( $post )
    {
        $get = DB::getConnection()->prepare( "SELECT id, password, state_id FROM users WHERE name = :name LIMIT 1" );
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
        $_SESSION['name']    = $post['name'];
        $_SESSION['user_id'] = $id['id'];

        History::add( array( 'message' => $_SESSION['name'] . ' loggade in', 'type_id' => 1 ) );

        return true;
    }
}
?>
