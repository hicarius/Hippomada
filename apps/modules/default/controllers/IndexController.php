<?php

class IndexController extends Controller
{

    /******
     * $cartelId = Commons::getRequestParameter('id', 0);
     * Debugger::dump( $this->getRequest()->getParams() );
     * Layout::setLayout('index');
     * $this->setNoRender();
     * if( !Session::isConnected() )
     * $this->getRequest()->getRequestParams();
     *****/




    public function index()
    {

        $oModel = Apps::getModel('Test');Debugger::dump($oModel);
        $oModel2 = Apps::getModel('Dc_Test');Debugger::dump($oModel2);
        $oModel1 = Apps::getResourceModel('Acl');Debugger::dump($oModel1);        
        //Layout::setLayout('index');
        $this->getView()->addVar('test', 155889);
        $this->getView()->addVar(
            array(
                "Male" => "M",
                "Nom" => "Jacques",
            )
        );
    }

    public function login()
    {
        Layout::setLayout('front/login');
    }

    public function connect()
    {
        $this->setNoRender();
        $tParams =  $this->getRequest()->getRequestParams();
        $oStable = Apps::getModel('Stable');
        if( $stable = $oStable->connectStable($tParams['email'], $tParams['password']) )
        {
            Session::setUser($stable);
            $URL =  "/ecurie";
        }else{
            $URL =  '/index/login/?error=invalid_username';
        }

        $this->getView()->redirect( $URL);
    }

    public function disconnect()
    {
        $this->setNoRender();
        Session::disconnected();
        $this->getView()->redirect( SITE_URL . "/");
    }
}