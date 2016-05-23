<?php

class Apps
{
    protected static $_oInstance;

    public static function getInstance()
    {
        if (null === self::$_oInstance) {
            self::$_oInstance = new self();
        }
        return self::$_oInstance;
    }
    
    public function dispatch()
    {
        try{
            $oRequest  = Request::getInstance();
            $oView = View::getInstance();
            Controller::process($oRequest, $oView)->printOut();
        }catch (Exception $oE){
            Controller::processException($oRequest, $oView, $oE)->printOut();
        }
    }

    public static function start()
    {
        global $oLayout;
        
        require 'apps/configs/config.inc.php';
        $oApplication = Apps::getInstance();
        $oApplication->autoloader();
        
        $oLayout = Layout::getInstance();        
        return $oApplication;
    }

    public function autoloader()
    {
        // Set include path
        $sPath = (string) get_include_path();
        $sPath .= (string) (PATH_SEPARATOR . LIBRARY_PATH );
        $sPath .= (string) (PATH_SEPARATOR . APPS_PATH );
        $sPath .= (string) (PATH_SEPARATOR . EXTENSIONS_PATH );
        $sPath .= (string) (PATH_SEPARATOR . APPS_PATH . '/models' );
        $sPath .= (string) (PATH_SEPARATOR . LIBRARY_PATH . '/Model/Resource' );

        set_include_path($sPath);
        spl_autoload_register( array('Apps','loadClass') );
    }

    public function loadClass($sClassName)
    {
        $sClassName = (string) str_replace('_', DIRECTORY_SEPARATOR, $sClassName);
        include_once($sClassName . '.php');
    }

    /**
     * Apps::getModel('Test');
     * @param string $sModelName
     * @return object Model_Abstract
     */
    public static function getModel( $sModelName )
    {
        $tModelDirectory = explode('_', $sModelName);
        array_pop($tModelDirectory);
        if( count($tModelDirectory) > 1 ){
            $sPath = (string) get_include_path();
            $sPath .= (string) (PATH_SEPARATOR . APPS_PATH .
                    '/models/' .  str_replace('_', '/', $sModelName));

            $sPathToAdded = APPS_PATH . '/models/' .  str_replace('_', '/', $sModelName);
            $tPaths = explode(PATH_SEPARATOR, get_include_path());
            if( !in_array($sPathToAdded, $tPaths) )
            {
                set_include_path($sPath);
            }
        }
        
        $sClassModel = $sModelName . 'Model';
        return new $sClassModel;
    }

     /**
     * Apps::getResourceModel('Acl');
     * @param string $sModelName
     * @return object Model_Abstract
     */
    public static function getResourceModel( $sModelName)
    {
        $sClassModel = $sModelName;
        return new $sClassModel;
    }
}
