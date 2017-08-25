<?php
class User
{
    public static function get_all()
    {
        $get = DB::getConnection()->prepare('SELECT * FROM tider');
        $get->execute();
        return $get->fetchAll();
    }
}
?>
