<?php
class Calendar
{
    public static function start_day()
    {
        $timestamp = strtotime( date( 'Y-m-01', time() ) );
        $day = date( 'D', $timestamp );
        return $day;
    }
}
?>
