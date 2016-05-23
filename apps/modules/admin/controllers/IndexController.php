<?php

class IndexController extends Controller
{
    public function index()
    {
        Layout::setLayout('admin');
    }

    public function login()
    {
        Layout::setLayout('admin/login');
    }

    public function connect()
    {
        $this->setNoRender();
        $tParams =  $this->getRequest()->getRequestParams();
        $err = '';

        if( $oUser = Session::matchAccount($tParams) )
        {
            Session::setUser($oUser);
            $URL = '/admin';
        }else{
            $err =  '/admin/index/login/?error=invalid_password';
            $URL = $err;
        }

        $this->getView()->redirect( $URL);
    }

    public function disconnect()
    {
        $this->setNoRender();
        Session::disconnected();
        $this->getView()->redirect( "admin/");
    }
}