<?php
function check( $get, $indexes )
{
    foreach( $get as $get )
    {
        if (empty( $get[$indexes] ) )
        {
            return false;
        }
        if( !isset( $get[$indexes] ) )
        {
            return false;
        }
    }
    return true;
}

function escape_string( &$string )
{
    $string = htmlspecialchars( $string, ENT_QUOTES, 'UTF-8' );
}

function escape( $var )
{
    array_walk_recursive( $var, "escape_string" );
    return $var;
}

function view( $path, $data = [] )
{
    $data = escape( $data );

    foreach( $data as $var => $variable )
    {
        $$var = $variable;
    }

    if( !isset( $data['error'] ) )
    {
        $error = 0;
    }
    else
    {
        $error = $data['error'];
    }

    if( !isset( $data['success'] ) )
    {
        $success = 0;
    }
    else
    {
        $success = $data['success'];
    }

    include( $_SERVER['DOCUMENT_ROOT'] .  '/' . DIRECTORY_NAME . '/views/_header.php' );
    include( $_SERVER['DOCUMENT_ROOT'] .  '/' . DIRECTORY_NAME . '/views/' . $path . '.php' );
    include( $_SERVER['DOCUMENT_ROOT'] .  '/' . DIRECTORY_NAME . '/views/_footer.php' );
}

function redirect( $path )
{
    ob_start();
    header( 'location: ' . $path );
    die();
}
?>
