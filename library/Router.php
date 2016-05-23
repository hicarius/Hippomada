<?php
class Router
{
    const DEFAULT_ACTION = 'index';
    const DEFAULT_CONTROLLER = 'index';
    const DEFAULT_MODULE = 'default';

    private static $_tRequest = array();

    protected static $_bUseRewriteEngine = USE_REWRITE_ENGINE;

    public static function parse(  )
    {
        self::_setRoute( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        Request::setParam( 'module', self::_getModule() );
        Request::setParam( 'controller', self::_getController() );
        Request::setParam( 'action', self::_getAction() );
        self::_setArgs();
    }

    protected static function _setRoute( $sRoute )
    {
        $sRoute = str_replace(SITE_URL, '', $sRoute);
        self::$_tRequest = explode( '/', $sRoute );
    }

    protected static function _getModule()
    {
        if(!self::_useDefaultModule())
        {
            if( isset( self::$_tRequest[0] ))
              return self::$_tRequest[0];
            else return self::DEFAULT_MODULE;
        }else
              return self::DEFAULT_MODULE;
    }

    protected static function _getController()
    {
        if( isset( self::$_tRequest[1 - self::_useDefaultModule()] ))
          return self::$_tRequest[1 - self::_useDefaultModule()];
        else
          return self::DEFAULT_CONTROLLER;
    }

    protected static function _getAction()
    {
        if( isset( self::$_tRequest[2 - self::_useDefaultModule()] ))
          return self::$_tRequest[2 - self::_useDefaultModule()];
        else
          return self::DEFAULT_ACTION;
    }

    protected static function _setArgs()
    {
        if( count( self::$_tRequest ) > (3 - self::_useDefaultModule()) )
          $tParam = array_slice ( self::$_tRequest, (3 - self::_useDefaultModule()) );
        else
          $tParam =  array();

        $sNextKey = NULL;
        $tArgs = array();
        foreach( $tParam as $iKey => $sValue )
        {
            if( $iKey%2 == 0 ){
                $sNextKey = $sValue;
                continue;
            }
            else
                $tArgs[$sNextKey] = $sValue;
        }
        Request::setParam('args', $tArgs);
    }

    public static function useRewriteEngine()
    {
        return self::$_bUseRewriteEngine;
    }

    private static function _useDefaultModule()
    {
        if( isset( self::$_tRequest[0] )){
            $sModuleName = self::$_tRequest[0];
        }
        $sModuleDirectory = APPS_PATH . '/modules/';
        $tModules = glob($sModuleDirectory . "*");
        if( !in_array($sModuleDirectory . $sModuleName, $tModules)){
            return 1;
        }else{
            return 0;
        }
    }
}