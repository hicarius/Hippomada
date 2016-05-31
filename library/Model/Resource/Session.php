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
        if($_REQUEST['module'] == 'admin') {
            $_SESSION['a_user'] =  $tUser;
        } else {
            $_SESSION['f_user'] =  $tUser;
        }
    }

    static function getUser()
    {

        if($_REQUEST['module'] == 'admin') {
            return isset($_SESSION['a_user']) ? $_SESSION['a_user'] : FALSE;
        } else {
            return isset($_SESSION['f_user']) ? $_SESSION['f_user'] : FALSE;
        }
    }

    static function isConnected()
    {
        if($_REQUEST['module'] == 'admin') {
            return isset($_SESSION['a_user']);
        } else {
            return isset($_SESSION['f_user']);
        }
    }

    static function disconnected()
    {
        if($_REQUEST['module'] == 'admin') {
            unset($_SESSION['a_user']);
        } else {
            unset($_SESSION['f_user']);
        }
    }

    static function matchAccount($tParams)
    {

        $oUser = false;
        if($tParams['module'] == 'admin') {
            if( $tParams['password'] == 'sovaly' && $tParams['email'] == 'admin@sovaly.loc' ) {
                $oUser = array(
                    'is_admin' => 1,
                    'udata' => '1',
                );
            }
        }
        return $oUser;
    }

    static function addMessage($msg, $code)
    {
        if($_REQUEST['module'] == 'admin') {
            $_SESSION['a_msg'] = array('message' => $msg, 'code' => $code);
        } else {
            $_SESSION['f_msg'] = array('message' => $msg, 'code' => $code);
        }
    }

    static function getMessage()
    {
        if($_REQUEST['module'] == 'admin') {
            if(isset($_SESSION['a_msg'])) {
                $msg = $_SESSION['a_msg'];
                unset($_SESSION['a_msg']);
                return $msg;
            }
        } else {
            if(isset($_SESSION['f_msg'])) {
                $msg = $_SESSION['f_msg'];
                unset($_SESSION['f_msg']);
                return $msg;
            }
        }
        return FALSE;
    }
}