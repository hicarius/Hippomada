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
        $tUserList = Session::userList();
        $err = '';
        if( $sNameSpace = Session::matchAccount($tParams['username'], Session::userList()) )
        {
            if( $tUserList[$sNameSpace]['password'] == $tParams['password'] )
            {
                Session::setUser($tUserList[$sNameSpace]);
                $URL = $tParams['forward'];
            }else{
                $err =  'index/login/?error=invalid_password';
                $URL = SITE_URL . "/" . $err;
            }
        }else{
            $err =  'index/login/?error=invalid_username';
            $URL = SITE_URL . "/" . $err;
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