<?php
class Controller extends Controller_Abstract
{
    protected $_bNoViewRendering = FALSE;

    protected $_viewUpdate = FALSE;

    protected static $_oInstance;

    public static function getInstance()
    {
        if (null === self::$_oInstance) {
            self::$_oInstance = new self();
        }
        return self::$_oInstance;
    }

    public static function process(Request $oRequest, View $oView)
    {
        global $oLayout;

        if ( OFFLINE_MODE == true )
        {
            Layout::render('site-offline');
            exit;
        }

        if( !Session::isConnected()) {
            if($oRequest->getAction() == 'Create' || $oRequest->getAction() == 'Connect' || $oRequest->getAction() == 'Login' ) {

            }else{
                $oRequest
                    ->setController('index')
                    ->setAction('login')
                    ->setPrematuredSessionEnd();
            }
        }


        $sRequestedModule = APPS_PATH . '/modules/' . $oRequest->getModule();
        $sModuleDirectory = APPS_PATH . '/modules/';
        $tModules = glob($sModuleDirectory . "*");
        if( !in_array($sRequestedModule, $tModules)){
            throw new Exception_ModuleNotExistException('module introuvable');
        }

        $sPath = $sModuleDirectory .$oRequest->getModule()
            . '/controllers/' . $oRequest->getController() .'Controller.php';

        $oLayout->_tArgs['module'] = $oRequest->getModule();
        $oLayout->_tArgs['controller'] = $oRequest->getController();
        $oLayout->_tArgs['action'] = $oRequest->getAction();

        if (!file_exists($sPath)){
            throw new Exception_ControllerNotExistException('contrôleur introuvable');
        }

        require_once($sPath);
        $oClass = $oRequest->getController() . 'Controller';
        $oController = new $oClass($oRequest, $oView);

        return $oController->launch();
    }

    public static function processException(Request $oRequest, View $oView, Exception $oE)
    {
        $oController = new self($oRequest, $oView);
        return $oController->launchException($oE);
    }

    public function launch()
    {
        global $oLayout;

        $sAction = $this->_oRequest->getAction();
        if (!$this->_actionExists($sAction)){
            throw new Exception_ActionNotExistException('Action introuvable');
        }
        // prefiltering
        $this->$sAction();

        // postfiltering
        if (!$this->_bRedirected){
            if(!$this->_bNoViewRendering){
                if(!$this->_viewUpdate){
                    $sViewContent = $this->_render( lcfirst($this->_oRequest->getController()) .
                        '/' . lcfirst($this->_oRequest->getAction()));
                }else{
                    $sViewContent = $this->_render( lcfirst($this->_oRequest->getController()) .
                        '/' . lcfirst($this->_viewUpdate));
                }

                $this->_oLayout->setViewContent($sViewContent);
                $this->_oLayout->setViewVars($this->getView()->getVars());
                $oLayout = $this->_oLayout;
                $this->_renderLayout($this->_oLayout->getPath(), $sViewContent);
            }
        }
        return $this->_oView;
    }

    public function launchException(Exception $oE)
    {
        $this->_oView->addVar('exception', $oE);
        if ($oE instanceof Exception_MVCException){
            $this->_render('error/404', false);
        }else{
            Debugger::dump($oE);
            $this->_render('error/500', false);
        }
        return $this->_oView;
    }

    protected function setNoRender()
    {
        $this->_bNoViewRendering = TRUE;
    }

    public function setViewUpdate( $sViewName )
    {
        $this->_viewUpdate = $sViewName;
    }
}