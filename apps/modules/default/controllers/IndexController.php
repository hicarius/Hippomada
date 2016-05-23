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
        Layout::setLayout('index');
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
            $URL =  "/";
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