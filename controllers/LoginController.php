<?php
class LoginController
{
    public function login()
    {
        view( 'login/view' );
    }
    public function dologin()
    {
        if( User::login( $_POST ) )
        {
            redirect('/');
        }
        else
        {
            view( 'login/view', array(
                'error'     => 1,
                'message'   => 'Namnet eller lösenordet var fel, Försök igen!'
            ) );
        }
    }

    public function logout()
    {
        History::add( array( 'message' => $_SESSION['name'] . ' loggade ut', 'type_id' => 1 ) );
        session_destroy();
        redirect('/');
    }
}
?>
