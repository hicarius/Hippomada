<?php
class Request extends Request_Abstract
{   
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
        if(Router::useRewriteEngine())
        {
            Router::parse();
        }

        $this->_initialize();
        $this->_tArgs = $this->getRequestParam('args');
    }
    
    private function _initialize()
    {
        $this->_sModule = ( $this->getRequestParam('module') ) ?
                ($this->getRequestParam('module')) : ('default') ;
        $this->_sController = ( $this->getRequestParam('controller') ) ?
                ($this->getRequestParam('controller')) : ('index') ;
        $this->_sAction = ( $this->getRequestParam('action') ) ?
                ($this->getRequestParam('action')) : ('index') ;
    }

    public function getPost()
    {
        return $_POST;
    }
}