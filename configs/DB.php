<?php
class DB
{
    private static $db;

    public static function init()
    {
        //self::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    }

    public static function getConnection()
    {
        return self::$db;
    }
}

?>
