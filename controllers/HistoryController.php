<?php
class HistoryController
{
    public function view()
    {
        view( 'history/view', array(
            'work_times' => History::get()
        ) );
    }
}
?>
