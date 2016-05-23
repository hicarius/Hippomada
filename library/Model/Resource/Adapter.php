<?php

/**
 *
 */
class Adapter
{
    private static $_link = null ;

    private static function getDefaultAdapter ( ) {
        if ( self :: $_link ) {
            return self :: $_link ;
        }

        $ini =  APPS_PATH . "/configs/database.ini" ;
        $parse = parse_ini_file ( $ini , true ) ;

        $driver = $parse [ "db_driver" ] ;
        $dsn = "${driver}:" ;
        $user = $parse [ "db_user" ] ;
        $password = $parse [ "db_password" ] ;
        $options = $parse [ "db_options" ] ;
        $attributes = $parse [ "db_attributes" ] ;

        foreach ( $parse [ "dsn" ] as $k => $v ) {
            $dsn .= "${k}=${v};" ;
        }

        self :: $_link = new PDO ( $dsn, $user, $password, $options ) ;

        foreach ( $attributes as $k => $v ) {
            self :: $_link -> setAttribute ( constant ( "PDO::{$k}" )
                , constant ( "PDO::{$v}" ) ) ;
        }

        return self :: $_link ;
    }

    /**
     * __callStatic
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public static function __callStatic ( $name, $args ) {
        $callback = array ( self :: getDefaultAdapter ( ), $name ) ;
        return call_user_func_array ( $callback , $args ) ;
    }
}