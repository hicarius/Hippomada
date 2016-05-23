<?php

class Layout
{
    protected $_sTitle;

    protected $_tStylesheet = array();

    protected $_tJavascript =  array();

    protected $_sPath;

    protected $_sViewContent;
    
    protected static $_oInstance;

    public static function getInstance()
    {
        if (null === self::$_oInstance) {
            self::$_oInstance = new self();
        }
        return self::$_oInstance;
    }

    public function  __construct()
    {
        $this->_sPath = APPS_PATH . '/layouts/general.phtml';
    }

    public function setLayoutUpdate($sLayoutUpdate)
    {
        $this->_sPath = APPS_PATH . '/layouts/' . $sLayoutUpdate . '.phtml';
    }

    public function getPath()
    {
        return $this->_sPath;
    }

    public function getViewContent()
    {
        return $this->_sViewContent;
    }

    public function setViewContent($sViewContent)
    {
        $this->_sViewContent = $sViewContent;
    }

    /*******STATIC-FUNCTION*********/
    
    public static function setLayout( $sLayout )
    {
        global $oLayout;
        $oLayout->setLayoutUpdate($sLayout);
        return $oLayout;
    }


    public static function renderView($sContent)
    {
        print $sContent;
    }
    
    public static function getJavascript()
    {
        global $oLayout;
    }

    public static function getStyleSheet()
    {
        global $oLayout;
    }

    public static function getTitle()
    {
        global $oLayout;
    }
}