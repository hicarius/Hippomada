<?php
class Session
{
    static function start()
    {
        session_start();
    }

    static function getNameSpace()
    {
        return (self::isAdminUser()) ? "admin" : "front";
    }
    
    static function isAdminUser()
    {

        if( $tUser = Session::getUser() )
        {
            return ($tUser['is_admin']);
        }
        return FALSE;
    }

    static function setUser( $tUser )
    {
        $_SESSION['user'] =  $tUser;
    }

    static function getUser()
    {
        return isset($_SESSION['user']) ? $_SESSION['user'] : FALSE;
    }

    static function isConnected()
    {
        return isset($_SESSION['user']);
    }

    static function disconnected()
    {
        unset($_SESSION['user']);
    }

    static function matchAccount($tParams)
    {

        $oUser = false;
        if($tParams['module'] == 'admin') {
            if( $tParams['password'] == 'sovaly' && $tParams['username'] == 'admin@sovaly.loc' ) {
                $oUser = array(
                    'is_admin' => 1,
                    'udata' => '1',
                );
            }
        } else {

        }


        return $oUser;
    }
}