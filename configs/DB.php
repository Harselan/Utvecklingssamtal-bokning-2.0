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
        } catch ( PDOException $e )
        {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }

    public static function getConnection()
    {
        return self::$db;
    }
}

?>
