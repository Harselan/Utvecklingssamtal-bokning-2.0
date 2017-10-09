<?php
class Calendar
{
    public static function get_connector( $time = 0 )
    {
        if( $time == 0 )
        {
            $time = time();
        }
        $array = array( 'Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thu' => 4, 'Fri' => 5, 'Sat' => 6, 'Sun' => 7 );
        return $array[ self::start_day( $time ) ];
    }

    public static function get_month( $time = 0 )
    {
        if( $time == 0 )
        {
            $time = time();
        }
        $array = array(
            'name'  => strftime( '%B', $time ),
            'date'  => date( 'm', $time )
        );
        return $array;
    }

    public static function get_year( $time = 0 )
    {
        if( $time == 0 )
        {
            $time = time();
        }

        return date( 'Y', $time );
    }

    public static function start_day( $time = 0 )
    {
        if( $time == 0 )
        {
            $time = time();
        }
        $timestamp = strtotime( date( 'Y-m-01',$time ) );
        $day = date( 'D', $timestamp );
        return $day;
    }

    public static function day_amount( $time = 0 )
    {
        if( $time == 0 )
        {
            $time = time();
        }
        return cal_days_in_month( CAL_GREGORIAN, date( 'm', $time ), date( 'Y', $time ) );
    }

    public static function week_amount( $month = 0, $year = 0 )
    {
        if( $month == 0 )
        {
            $month = date( 'm', time() );
        }

        if( $year == 0 )
        {
            $year = date( 'Y', time() );
        }

        $num_of_days = date( "t", mktime( 0,0,0,$month,1,$year ) );
        $lastday = date( "t", mktime( 0, 0, 0, $month, 1, $year ) );
        $day = self::start_day();

        if($day == "Sun")
        {
            $count_weeks = 1;
        }
        else
        {
            $count_weeks = 0;
        }
        $no_of_weeks = 0;

        while( $no_of_weeks < $lastday )
        {
            $no_of_weeks += 7;
            $count_weeks++;
        }

        return $count_weeks;
    }
}
?>
