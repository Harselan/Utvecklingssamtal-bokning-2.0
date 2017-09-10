<?php
class HistoryController
{
    public function view( $page = 1 )
    {

        view( 'history/view', array(
            'work_times' => History::get( $page ),
            'page'       => $page
        ) );
    }

    public function viewWork( $page = 1 )
    {

        view( 'history/viewWork', array(
            'work_times' => History::get_work( $page ),
            'page'       => $page
        ) );
    }
}
?>
