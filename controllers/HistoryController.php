<?php
class HistoryController
{
    public function view()
    {
        view( 'history/view', array(
            'work_times' => History::get()
        ) );
    }

    public function viewWork( $id = 0 )
    {
        view( 'history/viewWork', array(
            'work_times' => History::get_work()
        ) );
    }
}
?>
