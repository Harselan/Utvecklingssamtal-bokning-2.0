<?php
class User
{
    public static function get_all()
    {
        $get = DB::getConnection()->prepare("SHOW TABLES FROM utvecklingssamtal");
        if( ! $get->execute() ) {
            die(var_export(DB::getConnection()->errorinfo(), TRUE));
        }
         var_dump($get->fetchAll());
         die();
    }
}
?>
