<?php
class DB
{
    private static $db;

    public static function init()
    {
        // self::$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        try
        {
            self::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch ( PDOException $e )
        {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function getConnection()
    {
        return self::$db;
    }

    private static function table_exists( $tablename )
    {
        $check = self::$db->prepare( "SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = :TABLE_NAME" );
        $check->execute( array( ':TABLE_NAME' => $tablename ) );

        if( $check->fetch()[ 0 ] > 0 )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>
