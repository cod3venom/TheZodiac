<?php


namespace Kernel\Classes\Security;

use Kernel\Classes\Security\Restrictions;

class Session extends Restrictions
{
    public function StartUp(){
        if(session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }
    public function session_add($KEY,$VALUE){
        if(session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION[$KEY] = $VALUE;
        }
    }
    public function Session_cleanup(){
        session_destroy();
        session_unset();
    }

    public function LoggedIN(){
        if(isset($_SESSION['USER_ID'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}